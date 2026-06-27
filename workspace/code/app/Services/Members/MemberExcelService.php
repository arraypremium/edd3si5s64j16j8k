<?php

namespace App\Services\Members;

use App\Models\Member;
use Carbon\Carbon;
use DateTimeInterface;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use OpenSpout\Common\Entity\Row;
use OpenSpout\Reader\XLSX\Reader;
use OpenSpout\Writer\XLSX\Writer;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Throwable;

class MemberExcelService
{
    /**
     * @var list<string>
     */
    private const SOURCE_OPTIONS = [
        'word_of_mouth',
        'google_business_account',
        'website',
        'instagram',
        'facebook',
        'whatsapp',
        'justdial',
        'referral',
        'other',
    ];

    /**
     * @var list<string>
     */
    private array $requiredColumns = ['name', 'email', 'contact', 'gender'];

    /**
     * @return array<string, string>
     */
    private function exportHeaders(): array
    {
        return [
            'id' => 'ID',
            'code' => 'Code',
            'name' => 'Name',
            'email' => 'Email',
            'contact' => 'Contact',
            'emergency_contact' => 'Emergency Contact',
            'gender' => 'Gender',
            'dob' => 'DOB',
            'health_issue' => 'Health Issue',
            'address' => 'Address',
            'country' => 'Country',
            'state' => 'State',
            'city' => 'City',
            'pincode' => 'Pincode',
            'source' => 'Source',
            'status' => 'Status',
            'created_at' => 'Created At',
        ];
    }

    /**
     * @return array<string, string>
     */
    private function importHeaders(): array
    {
        return [
            'code' => 'Code',
            'name' => 'Name (required)',
            'email' => 'Email (required)',
            'contact' => 'Contact (required)',
            'emergency_contact' => 'Emergency Contact',
            'gender' => 'Gender (required)',
            'dob' => 'DOB YYYY-MM-DD',
            'health_issue' => 'Health Issue',
            'address' => 'Address',
            'country' => 'Country',
            'state' => 'State',
            'city' => 'City',
            'pincode' => 'Pincode',
            'source' => 'Source',
            'status' => 'Status active/inactive',
        ];
    }

    public function downloadExport(): BinaryFileResponse
    {
        $filePath = $this->temporaryFilePath('members-export');
        $writer = new Writer();
        $writer->openToFile($filePath);

        $headers = $this->exportHeaders();
        $writer->addRow(Row::fromValues(array_values($headers)));

        Member::query()
            ->orderBy('id')
            ->chunk(500, function ($members) use ($writer, $headers): void {
                foreach ($members as $member) {
                    $writer->addRow(Row::fromValues($this->memberToExportRow($member, array_keys($headers))));
                }
            });

        $writer->close();

        return response()
            ->download($filePath, 'members-export-'.now()->format('Y-m-d-His').'.xlsx')
            ->deleteFileAfterSend(true);
    }

    public function downloadDemoTemplate(): BinaryFileResponse
    {
        $filePath = $this->temporaryFilePath('members-import-demo');
        $writer = new Writer();
        $writer->openToFile($filePath);

        $writer->addRow(Row::fromValues(array_values($this->importHeaders())));
        $writer->addRow(Row::fromValues([
            '',
            'Demo Member',
            'demo.member.'.now()->format('YmdHis').'@example.com',
            '+91 9876543210',
            '+91 9876543211',
            'male',
            '1995-01-15',
            '',
            '221B Demo Street',
            'India',
            'Gujarat',
            'Ahmedabad',
            '380001',
            'word_of_mouth',
            'active',
        ]));

        $writer->close();

        return response()
            ->download($filePath, 'members-import-demo.xlsx')
            ->deleteFileAfterSend(true);
    }

    public function import(string $filePath): MemberImportResult
    {
        $errors = [];
        $validRows = [];
        $seenEmails = [];
        $totalRows = 0;

        if (! is_file($filePath)) {
            return new MemberImportResult(errors: ['Uploaded Excel file could not be found.']);
        }

        if (strtolower(pathinfo($filePath, PATHINFO_EXTENSION)) !== 'xlsx') {
            return new MemberImportResult(errors: ['Only .xlsx Excel files are supported. Please download the demo import file and use that format.']);
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

                        $missingColumns = array_values(array_filter(
                            $this->requiredColumns,
                            fn (string $column): bool => ! array_key_exists($column, $headerMap),
                        ));

                        foreach ($missingColumns as $column) {
                            $errors[] = 'Header row is missing required column: '.$this->humanColumn($column).'.';
                        }

                        if ($missingColumns !== []) {
                            $reader->close();

                            return new MemberImportResult(errors: $errors);
                        }

                        continue;
                    }

                    if ($this->isEmptyRow($values)) {
                        continue;
                    }

                    $totalRows++;
                    $rowData = $this->extractRowData($values, $headerMap);
                    $rowErrors = $this->validateRow($rowData, $rowNumber, $seenEmails);

                    if ($rowErrors !== []) {
                        array_push($errors, ...$rowErrors);
                        continue;
                    }

                    $email = strtolower((string) $rowData['email']);
                    $seenEmails[$email] = true;

                    $validRows[] = [
                        'row_number' => $rowNumber,
                        'data' => $rowData,
                    ];
                }

                break;
            }

            $reader->close();
        } catch (Throwable $exception) {
            try {
                $reader->close();
            } catch (Throwable) {
                //
            }

            return new MemberImportResult(errors: [
                'Could not read Excel file. Please verify it is a valid .xlsx file. '.$exception->getMessage(),
            ]);
        }

        if (! $headerRead) {
            return new MemberImportResult(errors: ['The Excel file is empty.']);
        }

        $imported = 0;

        foreach ($validRows as $validRow) {
            $rowNumber = (int) $validRow['row_number'];
            $rowData = $validRow['data'];

            try {
                Member::create($rowData);
                $imported++;
            } catch (Throwable $exception) {
                $errors[] = "Row {$rowNumber}: Could not import member. ".$exception->getMessage();
            }
        }

        $skipped = max($totalRows - $imported, 0);

        if ($totalRows === 0) {
            $errors[] = 'The Excel file does not contain any member rows.';
        }

        return new MemberImportResult(
            imported: $imported,
            skipped: $skipped,
            totalRows: $totalRows,
            errors: $errors,
        );
    }

    /**
     * @param  list<string>  $columns
     * @return list<mixed>
     */
    private function memberToExportRow(Member $member, array $columns): array
    {
        return array_map(function (string $column) use ($member): mixed {
            return match ($column) {
                'dob' => $member->dob?->format('Y-m-d'),
                'status' => $member->status?->value ?? (string) $member->status,
                'created_at' => $member->created_at?->format('Y-m-d H:i:s'),
                default => $member->{$column},
            };
        }, $columns);
    }

    /**
     * @return list<mixed>
     */
    private function rowToValues(Row $row): array
    {
        return array_map(
            fn ($cell): mixed => $cell->getValue(),
            $row->getCells(),
        );
    }

    /**
     * @param  list<mixed>  $headers
     * @return array<string, int>
     */
    private function headerMap(array $headers): array
    {
        $map = [];

        foreach ($headers as $index => $header) {
            $normalized = $this->normalizeHeader((string) $this->cellToString($header));

            if ($normalized !== '') {
                $map[$normalized] = $index;
            }
        }

        return $map;
    }

    private function normalizeHeader(string $header): string
    {
        $header = preg_replace('/\s*\(required\)\s*/i', '', $header) ?? $header;
        $header = strtolower(trim($header));
        $header = preg_replace('/[^a-z0-9]+/', '_', $header) ?? $header;
        $header = trim($header, '_');

        return match ($header) {
            'member_code' => 'code',
            'full_name' => 'name',
            'phone', 'phone_number', 'mobile', 'mobile_number' => 'contact',
            'emergency_phone', 'emergency_phone_number', 'emergency_mobile' => 'emergency_contact',
            'date_of_birth', 'birth_date', 'dob_yyyy_mm_dd' => 'dob',
            'health_issues', 'medical_issue', 'medical_issues' => 'health_issue',
            'pin_code', 'zip', 'zip_code', 'postal_code' => 'pincode',
            'status_active_inactive' => 'status',
            default => $header,
        };
    }

    /**
     * @param  list<mixed>  $values
     * @param  array<string, int>  $headerMap
     * @return array<string, mixed>
     */
    private function extractRowData(array $values, array $headerMap): array
    {
        $data = [];

        foreach (array_keys($this->importHeaders()) as $column) {
            $index = $headerMap[$column] ?? null;
            $value = $index === null ? null : ($values[$index] ?? null);
            $data[$column] = $this->cellToString($value);
        }

        $data['email'] = strtolower((string) $data['email']);
        $data['gender'] = $this->normalizeGender((string) $data['gender']);
        $data['status'] = $this->normalizeStatus((string) $data['status']);
        $data['dob'] = $this->normalizeDate($data['dob']);

        return array_filter(
            $data,
            fn (mixed $value): bool => ! ($value === null || $value === ''),
        );
    }

    /**
     * @param  array<string, mixed>  $data
     * @param  array<string, bool>  $seenEmails
     * @return list<string>
     */
    private function validateRow(array $data, int $rowNumber, array $seenEmails): array
    {
        $validator = Validator::make($data, [
            'code' => ['nullable', 'string', 'max:255'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('members', 'email')],
            'contact' => ['required', 'string', 'max:20', 'regex:/^\+?[0-9\s\-\(\)]+$/'],
            'emergency_contact' => ['nullable', 'string', 'max:20', 'regex:/^\+?[0-9\s\-\(\)]+$/'],
            'gender' => ['required', Rule::in(['male', 'female', 'other'])],
            'dob' => ['nullable', 'date'],
            'health_issue' => ['nullable', 'string', 'max:500'],
            'address' => ['nullable', 'string'],
            'country' => ['nullable', 'string', 'max:255'],
            'state' => ['nullable', 'string', 'max:255'],
            'city' => ['nullable', 'string', 'max:255'],
            'pincode' => ['nullable', 'string', 'max:255'],
            'source' => ['nullable', 'string', Rule::in(self::SOURCE_OPTIONS)],
            'status' => ['nullable', Rule::in(['active', 'inactive'])],
        ], [
            'contact.regex' => 'The contact field must contain only digits, spaces, dashes, parentheses, and optional + sign.',
            'emergency_contact.regex' => 'The emergency contact field must contain only digits, spaces, dashes, parentheses, and optional + sign.',
        ]);

        $errors = [];

        if ($validator->fails()) {
            foreach ($validator->errors()->all() as $message) {
                $errors[] = "Row {$rowNumber}: {$message}";
            }
        }

        $email = strtolower((string) ($data['email'] ?? ''));

        if ($email !== '' && isset($seenEmails[$email])) {
            $errors[] = "Row {$rowNumber}: Duplicate email '{$email}' appears more than once in this Excel file.";
        }

        return $errors;
    }

    private function normalizeGender(string $gender): string
    {
        $value = strtolower(trim($gender));

        return match ($value) {
            'm' => 'male',
            'f' => 'female',
            'o' => 'other',
            default => $value,
        };
    }

    private function normalizeStatus(string $status): string
    {
        $value = strtolower(trim($status));

        if ($value === '') {
            return 'active';
        }

        return match ($value) {
            'enabled' => 'active',
            'disabled' => 'inactive',
            default => $value,
        };
    }

    private function normalizeDate(mixed $value): ?string
    {
        if ($value instanceof DateTimeInterface) {
            return Carbon::instance($value)->toDateString();
        }

        $value = trim((string) $value);

        if ($value === '') {
            return null;
        }

        foreach (['Y-m-d', 'd-m-Y', 'd/m/Y', 'm/d/Y'] as $format) {
            try {
                $date = Carbon::createFromFormat($format, $value);

                if ($date !== false) {
                    return $date->toDateString();
                }
            } catch (Throwable) {
                //
            }
        }

        try {
            return Carbon::parse($value)->toDateString();
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

    private function humanColumn(string $column): string
    {
        return ucwords(str_replace('_', ' ', $column));
    }

    private function temporaryFilePath(string $prefix): string
    {
        $directory = storage_path('app/private/exports/members');
        File::ensureDirectoryExists($directory);

        return $directory.'/'.$prefix.'-'.now()->format('YmdHis').'-'.bin2hex(random_bytes(4)).'.xlsx';
    }
}
