<?php

namespace App\Services\Excel;

use App\Models\Expense;
use App\Models\Invoice;
use App\Models\Member;
use App\Models\Plan;
use App\Models\Service;
use App\Models\Subscription;
use Carbon\Carbon;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use OpenSpout\Common\Entity\Row;
use OpenSpout\Reader\XLSX\Reader;
use OpenSpout\Writer\XLSX\Writer;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Throwable;

class ResourceExcelService
{
    /**
     * Download an Excel export.
     * When a filtered Filament table query is passed, only those filtered records are exported.
     */
    public function downloadExport(string $resource, ?Builder $query = null): BinaryFileResponse
    {
        $config = $this->config($resource);
        $filePath = $this->temporaryFilePath($resource.'-export');

        $writer = new Writer();
        $writer->openToFile($filePath);

        $columns = $config['columns'];

        $writer->addRow(Row::fromValues(array_map(
            fn (array $column): string => (string) $column['label'],
            $columns,
        )));

        $query ??= $config['model']::query();

        foreach (($config['with'] ?? []) as $relation) {
            $query->with($relation);
        }

        $query->orderBy($query->getModel()->getQualifiedKeyName())
            ->chunk(500, function ($records) use ($writer, $columns): void {
                foreach ($records as $record) {
                    $writer->addRow(Row::fromValues($this->recordToRow($record, $columns)));
                }
            });

        $writer->close();

        return response()
            ->download($filePath, $resource.'-export-'.now()->format('Y-m-d-His').'.xlsx')
            ->deleteFileAfterSend(true);
    }

    /**
     * Download a demo import template.
     * Required columns are marked with (required).
     */
    public function downloadDemo(string $resource): BinaryFileResponse
    {
        $config = $this->config($resource);
        $filePath = $this->temporaryFilePath($resource.'-import-demo');

        $writer = new Writer();
        $writer->openToFile($filePath);

        $columns = $config['columns'];

        $writer->addRow(Row::fromValues(array_map(
            fn (array $column): string => (string) $column['label'].(($column['required'] ?? false) ? ' (required)' : ''),
            $columns,
        )));

        $writer->addRow(Row::fromValues($config['demo']));
        $writer->close();

        return response()
            ->download($filePath, $resource.'-import-demo.xlsx')
            ->deleteFileAfterSend(true);
    }

    /**
     * Import an Excel file.
     * Invalid rows are skipped; valid rows are imported.
     */
    public function import(string $resource, string $filePath): ExcelImportResult
    {
        $config = $this->config($resource);
        $columns = $config['columns'];

        $errors = [];
        $validRows = [];
        $totalRows = 0;
        $seenUnique = [];

        if (! is_file($filePath)) {
            return new ExcelImportResult(errors: ['Uploaded Excel file could not be found.']);
        }

        if (strtolower(pathinfo($filePath, PATHINFO_EXTENSION)) !== 'xlsx') {
            return new ExcelImportResult(errors: ['Only .xlsx Excel files are supported.']);
        }

        $reader = new Reader();

        try {
            $reader->open($filePath);

            $headerMap = [];
            $headerRead = false;
            $rowNumber = 0;

            foreach ($reader->getSheetIterator() as $sheet) {
                foreach ($sheet->getRowIterator() as $row) {
                    $rowNumber++;
                    $values = $this->rowToValues($row);

                    if (! $headerRead) {
                        $headerMap = $this->headerMap($values);
                        $headerRead = true;

                        $missing = [];

                        foreach ($columns as $column) {
                            if (($column['required'] ?? false) && ! array_key_exists($column['key'], $headerMap)) {
                                $missing[] = $column['label'];
                            }
                        }

                        if ($missing !== []) {
                            $reader->close();

                            return new ExcelImportResult(errors: array_map(
                                fn (string $column): string => "Header row is missing required column: {$column}.",
                                $missing,
                            ));
                        }

                        continue;
                    }

                    if ($this->isEmptyRow($values)) {
                        continue;
                    }

                    $totalRows++;

                    $rowData = $this->extractRowData($values, $headerMap, $columns);
                    $prepared = $this->prepareRow($resource, $rowData, $rowNumber, $errors);

                    if ($prepared === null) {
                        continue;
                    }

                    $validator = Validator::make($prepared, $config['rules'] ?? []);

                    if ($validator->fails()) {
                        foreach ($validator->errors()->all() as $message) {
                            $errors[] = "Row {$rowNumber}: {$message}";
                        }

                        continue;
                    }

                    foreach (($config['unique_in_file'] ?? []) as $uniqueKey) {
                        $value = strtolower((string) ($prepared[$uniqueKey] ?? ''));

                        if ($value === '') {
                            continue;
                        }

                        if (isset($seenUnique[$uniqueKey][$value])) {
                            $errors[] = "Row {$rowNumber}: Duplicate {$uniqueKey} '{$value}' appears more than once in this Excel file.";
                            continue 2;
                        }

                        $seenUnique[$uniqueKey][$value] = true;
                    }

                    $validRows[] = [
                        'row_number' => $rowNumber,
                        'data' => $prepared,
                    ];
                }

                break;
            }

            $reader->close();
        } catch (Throwable $exception) {
            try {
                $reader->close();
            } catch (Throwable) {
                // ignore
            }

            return new ExcelImportResult(errors: ['Could not read Excel file. '.$exception->getMessage()]);
        }

        if (! $headerRead) {
            return new ExcelImportResult(errors: ['The Excel file is empty.']);
        }

        $imported = 0;

        foreach ($validRows as $validRow) {
            try {
                $this->createRecord($resource, $validRow['data']);
                $imported++;
            } catch (Throwable $exception) {
                $errors[] = 'Row '.$validRow['row_number'].': Could not import. '.$exception->getMessage();
            }
        }

        if ($totalRows === 0) {
            $errors[] = 'The Excel file does not contain any data rows.';
        }

        return new ExcelImportResult(
            imported: $imported,
            skipped: max($totalRows - $imported, 0),
            totalRows: $totalRows,
            errors: $errors,
        );
    }

    /**
     * @return array<string, mixed>
     */
    private function config(string $resource): array
    {
        $configs = [
            'services' => [
                'model' => Service::class,
                'columns' => [
                    ['key' => 'id', 'label' => 'ID'],
                    ['key' => 'name', 'label' => 'Name', 'required' => true],
                    ['key' => 'description', 'label' => 'Description'],
                ],
                'rules' => [
                    'name' => ['required', 'string', 'max:255'],
                    'description' => ['nullable', 'string', 'max:255'],
                ],
                'demo' => ['', 'Gym Access', 'General gym floor access'],
                'unique_in_file' => ['name'],
            ],

            'plans' => [
                'model' => Plan::class,
                'with' => ['service'],
                'columns' => [
                    ['key' => 'id', 'label' => 'ID'],
                    ['key' => 'service_name', 'label' => 'Service Name', 'required' => true],
                    ['key' => 'code', 'label' => 'Code', 'required' => true],
                    ['key' => 'name', 'label' => 'Name', 'required' => true],
                    ['key' => 'description', 'label' => 'Description'],
                    ['key' => 'days', 'label' => 'Days', 'required' => true],
                    ['key' => 'amount', 'label' => 'Amount', 'required' => true],
                    ['key' => 'status', 'label' => 'Status active/inactive'],
                ],
                'rules' => [
                    'service_id' => ['required', 'integer', 'exists:services,id'],
                    'code' => ['required', 'string', 'max:255', Rule::unique('plans', 'code')],
                    'name' => ['required', 'string', 'max:255', Rule::unique('plans', 'name')],
                    'description' => ['nullable', 'string', 'max:255'],
                    'days' => ['required', 'integer', 'min:1'],
                    'amount' => ['required', 'numeric', 'min:0'],
                    'status' => ['nullable', Rule::in(['active', 'inactive'])],
                ],
                'demo' => ['', 'Gym Access', 'MONTHLY', 'Monthly Plan', 'One month membership', 30, 1500, 'active'],
                'unique_in_file' => ['code', 'name'],
            ],

            'subscriptions' => [
                'model' => Subscription::class,
                'with' => ['member', 'plan'],
                'columns' => [
                    ['key' => 'id', 'label' => 'ID'],
                    ['key' => 'member_email', 'label' => 'Member Email', 'required' => true],
                    ['key' => 'member_code', 'label' => 'Member Code'],
                    ['key' => 'plan_code', 'label' => 'Plan Code', 'required' => true],
                    ['key' => 'plan_name', 'label' => 'Plan Name'],
                    ['key' => 'renewed_from_subscription_id', 'label' => 'Renewed From Subscription ID'],
                    ['key' => 'start_date', 'label' => 'Start Date YYYY-MM-DD', 'required' => true],
                    ['key' => 'end_date', 'label' => 'End Date YYYY-MM-DD', 'required' => true],
                    ['key' => 'status', 'label' => 'Status upcoming/ongoing/expiring/expired/renewed'],
                ],
                'rules' => [
                    'member_id' => ['required', 'integer', 'exists:members,id'],
                    'plan_id' => ['required', 'integer', 'exists:plans,id'],
                    'renewed_from_subscription_id' => ['nullable', 'integer', 'exists:subscriptions,id'],
                    'start_date' => ['required', 'date'],
                    'end_date' => ['required', 'date', 'after_or_equal:start_date'],
                    'status' => ['nullable', Rule::in(['upcoming', 'ongoing', 'expiring', 'expired', 'renewed'])],
                ],
                'demo' => ['', 'member@example.com', 'MEM001', 'MONTHLY', 'Monthly Plan', '', now()->toDateString(), now()->addDays(30)->toDateString(), 'ongoing'],
            ],

            'invoices' => [
                'model' => Invoice::class,
                'with' => ['subscription.member', 'subscription.plan'],
                'columns' => [
                    ['key' => 'id', 'label' => 'ID'],
                    ['key' => 'number', 'label' => 'Invoice Number', 'required' => true],
                    ['key' => 'subscription_id', 'label' => 'Subscription ID'],
                    ['key' => 'member_email', 'label' => 'Member Email'],
                    ['key' => 'plan_code', 'label' => 'Plan Code'],
                    ['key' => 'date', 'label' => 'Invoice Date YYYY-MM-DD', 'required' => true],
                    ['key' => 'due_date', 'label' => 'Due Date YYYY-MM-DD'],
                    ['key' => 'payment_method', 'label' => 'Payment Method'],
                    ['key' => 'discount', 'label' => 'Discount %'],
                    ['key' => 'discount_amount', 'label' => 'Discount Amount'],
                    ['key' => 'discount_note', 'label' => 'Discount Note'],
                    ['key' => 'paid_amount', 'label' => 'Paid Amount'],
                    ['key' => 'subscription_fee', 'label' => 'Subscription Fee', 'required' => true],
                    ['key' => 'status', 'label' => 'Status issued/paid/partial/overdue/refund/cancelled'],
                ],
                'rules' => [
                    'number' => ['required', 'string', 'max:255', Rule::unique('invoices', 'number')],
                    'subscription_id' => ['required', 'integer', 'exists:subscriptions,id', Rule::unique('invoices', 'subscription_id')],
                    'date' => ['required', 'date'],
                    'due_date' => ['nullable', 'date'],
                    'payment_method' => ['nullable', 'string', 'max:255'],
                    'discount' => ['nullable', 'numeric', 'min:0'],
                    'discount_amount' => ['nullable', 'numeric', 'min:0'],
                    'discount_note' => ['nullable', 'string', 'max:255'],
                    'paid_amount' => ['nullable', 'numeric', 'min:0'],
                    'subscription_fee' => ['required', 'numeric', 'min:0'],
                    'status' => ['nullable', Rule::in(['issued', 'paid', 'partial', 'overdue', 'refund', 'cancelled'])],
                ],
                'demo' => ['', 'INV-DEMO-001', 1, 'member@example.com', 'MONTHLY', now()->toDateString(), now()->addDays(7)->toDateString(), 'cash', 0, 0, '', 0, 1500, 'issued'],
                'unique_in_file' => ['number'],
            ],

            'expenses' => [
                'model' => Expense::class,
                'columns' => [
                    ['key' => 'id', 'label' => 'ID'],
                    ['key' => 'name', 'label' => 'Name', 'required' => true],
                    ['key' => 'amount', 'label' => 'Amount', 'required' => true],
                    ['key' => 'date', 'label' => 'Date YYYY-MM-DD', 'required' => true],
                    ['key' => 'due_date', 'label' => 'Due Date YYYY-MM-DD'],
                    ['key' => 'paid_at', 'label' => 'Paid At YYYY-MM-DD HH:MM:SS'],
                    ['key' => 'category', 'label' => 'Category', 'required' => true],
                    ['key' => 'status', 'label' => 'Status pending/paid/overdue/cancelled'],
                    ['key' => 'vendor', 'label' => 'Vendor'],
                    ['key' => 'notes', 'label' => 'Notes'],
                ],
                'rules' => [
                    'name' => ['required', 'string', 'max:255'],
                    'amount' => ['required', 'numeric', 'min:0'],
                    'date' => ['required', 'date'],
                    'due_date' => ['nullable', 'date'],
                    'paid_at' => ['nullable', 'date'],
                    'category' => ['required', 'string', 'max:100'],
                    'status' => ['nullable', Rule::in(['pending', 'paid', 'overdue', 'cancelled'])],
                    'vendor' => ['nullable', 'string', 'max:255'],
                    'notes' => ['nullable', 'string'],
                ],
                'demo' => ['', 'Electricity Bill', 2500, now()->toDateString(), now()->addDays(5)->toDateString(), '', 'utilities', 'pending', 'Power Company', 'Monthly electricity bill'],
            ],
        ];

        if (! isset($configs[$resource])) {
            throw new \InvalidArgumentException("Excel resource [{$resource}] is not configured.");
        }

        return $configs[$resource];
    }

    /**
     * @param  list<array<string, mixed>>  $columns
     * @return list<mixed>
     */
    private function recordToRow(Model $record, array $columns): array
    {
        return array_map(function (array $column) use ($record): mixed {
            $key = (string) $column['key'];

            $value = match ($key) {
                'service_name' => $record instanceof Plan ? $record->service?->name : null,
                'member_email' => $record instanceof Subscription ? $record->member?->email : ($record instanceof Invoice ? $record->subscription?->member?->email : null),
                'member_code' => $record instanceof Subscription ? $record->member?->code : null,
                'plan_code' => $record instanceof Subscription ? $record->plan?->code : ($record instanceof Invoice ? $record->subscription?->plan?->code : null),
                'plan_name' => $record instanceof Subscription ? $record->plan?->name : null,
                default => $record->{$key} ?? null,
            };

            if ($value instanceof DateTimeInterface) {
                return Carbon::instance($value)->format(str_contains($key, 'at') ? 'Y-m-d H:i:s' : 'Y-m-d');
            }

            if (is_object($value) && property_exists($value, 'value')) {
                return $value->value;
            }

            return $value;
        }, $columns);
    }

    /**
     * @return list<mixed>
     */
    private function rowToValues(Row $row): array
    {
        return array_map(fn ($cell): mixed => $cell->getValue(), $row->getCells());
    }

    /**
     * @param  list<mixed>  $headers
     * @return array<string, int>
     */
    private function headerMap(array $headers): array
    {
        $map = [];

        foreach ($headers as $index => $header) {
            $key = $this->normalizeHeader($this->cellToString($header));

            if ($key !== '') {
                $map[$key] = $index;
            }
        }

        return $map;
    }

    private function normalizeHeader(string $header): string
    {
        $header = preg_replace('/\s*\(required\)\s*/i', '', $header) ?? $header;
        $header = preg_replace('/\s+YYYY[-\/ ]MM[-\/ ]DD(\s+HH:MM:SS)?/i', '', $header) ?? $header;
        $header = preg_replace('/\s+active\/inactive/i', '', $header) ?? $header;
        $header = preg_replace('/\s+upcoming\/ongoing\/expiring\/expired\/renewed/i', '', $header) ?? $header;
        $header = preg_replace('/\s+issued\/paid\/partial\/overdue\/refund\/cancelled/i', '', $header) ?? $header;
        $header = preg_replace('/\s+pending\/paid\/overdue\/cancelled/i', '', $header) ?? $header;
        $header = strtolower(trim($header));
        $header = preg_replace('/[^a-z0-9]+/', '_', $header) ?? $header;
        $header = trim($header, '_');

        return match ($header) {
            'invoice_number' => 'number',
            'discount_percent', 'discount' => 'discount',
            'date' => 'date',
            default => $header,
        };
    }

    /**
     * @param  list<mixed>  $values
     * @param  array<string, int>  $headerMap
     * @param  list<array<string, mixed>>  $columns
     * @return array<string, mixed>
     */
    private function extractRowData(array $values, array $headerMap, array $columns): array
    {
        $data = [];

        foreach ($columns as $column) {
            $key = (string) $column['key'];

            if ($key === 'id') {
                continue;
            }

            $index = $headerMap[$key] ?? null;
            $data[$key] = $index === null ? null : $this->cellToString($values[$index] ?? null);
        }

        return array_filter($data, fn (mixed $value): bool => ! ($value === null || $value === ''));
    }

    /**
     * @param  array<string, mixed>  $data
     * @param  list<string>  $errors
     * @return array<string, mixed>|null
     */
    private function prepareRow(string $resource, array $data, int $rowNumber, array &$errors): ?array
    {
        foreach (['date', 'due_date', 'paid_at', 'dob', 'start_date', 'end_date'] as $dateKey) {
            if (isset($data[$dateKey])) {
                $data[$dateKey] = $this->normalizeDate($data[$dateKey], str_ends_with($dateKey, '_at'));
            }
        }

        foreach (['status', 'gender'] as $key) {
            if (isset($data[$key])) {
                $data[$key] = strtolower(trim((string) $data[$key]));
            }
        }

        if ($resource === 'plans') {
            $service = Service::query()->where('name', $data['service_name'] ?? '')->first();

            if (! $service) {
                $errors[] = "Row {$rowNumber}: Service '{$data['service_name']}' was not found. Import/create services first.";

                return null;
            }

            $data['service_id'] = $service->id;
            unset($data['service_name']);
        }

        if ($resource === 'subscriptions') {
            $member = Member::query()
                ->when($data['member_email'] ?? null, fn (Builder $query, string $email) => $query->where('email', strtolower($email)))
                ->when(! ($data['member_email'] ?? null) && ($data['member_code'] ?? null), fn (Builder $query) => $query->where('code', $data['member_code']))
                ->first();

            $plan = Plan::query()
                ->when($data['plan_code'] ?? null, fn (Builder $query, string $code) => $query->where('code', $code))
                ->when(! ($data['plan_code'] ?? null) && ($data['plan_name'] ?? null), fn (Builder $query) => $query->where('name', $data['plan_name']))
                ->first();

            if (! $member) {
                $errors[] = "Row {$rowNumber}: Member was not found. Import/create members first.";

                return null;
            }

            if (! $plan) {
                $errors[] = "Row {$rowNumber}: Plan was not found. Import/create plans first.";

                return null;
            }

            $data['member_id'] = $member->id;
            $data['plan_id'] = $plan->id;

            unset($data['member_email'], $data['member_code'], $data['plan_code'], $data['plan_name']);
        }

        if ($resource === 'invoices') {
            if (! isset($data['subscription_id'])) {
                $memberEmail = strtolower((string) ($data['member_email'] ?? ''));
                $planCode = (string) ($data['plan_code'] ?? '');

                $subscription = Subscription::query()
                    ->whereHas('member', fn (Builder $query) => $query->where('email', $memberEmail))
                    ->whereHas('plan', fn (Builder $query) => $query->where('code', $planCode))
                    ->latest('id')
                    ->first();

                if (! $subscription) {
                    $errors[] = "Row {$rowNumber}: Subscription was not found. Provide Subscription ID or valid Member Email + Plan Code.";

                    return null;
                }

                $data['subscription_id'] = $subscription->id;
            }

            unset($data['member_email'], $data['plan_code']);
        }

        if (! isset($data['status'])) {
            $data['status'] = match ($resource) {
                'plans' => 'active',
                'subscriptions' => 'ongoing',
                'invoices' => 'issued',
                'expenses' => 'pending',
                default => null,
            };
        }

        return array_filter($data, fn (mixed $value): bool => ! ($value === null || $value === ''));
    }

    /**
     * @param  array<string, mixed>  $data
     */
    private function createRecord(string $resource, array $data): Model
    {
        return match ($resource) {
            'services' => Service::create($data),
            'plans' => Plan::create($data),
            'subscriptions' => Subscription::create($data),
            'invoices' => Invoice::create($data),
            'expenses' => Expense::create($data),
            default => throw new \InvalidArgumentException("Unsupported resource [{$resource}]."),
        };
    }

    private function normalizeDate(mixed $value, bool $dateTime = false): string
    {
        if ($value instanceof DateTimeInterface) {
            return Carbon::instance($value)->format($dateTime ? 'Y-m-d H:i:s' : 'Y-m-d');
        }

        $value = trim((string) $value);

        foreach (['Y-m-d H:i:s', 'Y-m-d H:i', 'Y-m-d', 'd-m-Y', 'd/m/Y', 'm/d/Y'] as $format) {
            try {
                $date = Carbon::createFromFormat($format, $value);

                if ($date !== false) {
                    return $date->format($dateTime ? 'Y-m-d H:i:s' : 'Y-m-d');
                }
            } catch (Throwable) {
                // try next format
            }
        }

        try {
            return Carbon::parse($value)->format($dateTime ? 'Y-m-d H:i:s' : 'Y-m-d');
        } catch (Throwable) {
            return $value;
        }
    }

    private function cellToString(mixed $value): string
    {
        if ($value instanceof DateTimeInterface) {
            return Carbon::instance($value)->toDateString();
        }

        return trim((string) $value);
    }

    /**
     * @param  list<mixed>  $values
     */
    private function isEmptyRow(array $values): bool
    {
        foreach ($values as $value) {
            if ($this->cellToString($value) !== '') {
                return false;
            }
        }

        return true;
    }

    private function temporaryFilePath(string $prefix): string
    {
        $directory = storage_path('app/private/exports/excel');
        File::ensureDirectoryExists($directory);

        return $directory.'/'.$prefix.'-'.now()->format('YmdHis').'-'.bin2hex(random_bytes(4)).'.xlsx';
    }
}