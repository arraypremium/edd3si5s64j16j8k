<?php

namespace App\Services\Excel;

class ExcelImportResult
{
    /**
     * @param  list<string>  $errors
     */
    public function __construct(
        public int $imported = 0,
        public int $skipped = 0,
        public int $totalRows = 0,
        public array $errors = [],
    ) {}

    public function hasErrors(): bool
    {
        return $this->errors !== [];
    }

    public function isSuccessful(): bool
    {
        return $this->imported > 0 && ! $this->hasErrors();
    }

    public function summary(int $limit = 15): string
    {
        $lines = [
            "Total data rows checked: {$this->totalRows}",
            "Imported: {$this->imported}",
            "Skipped: {$this->skipped}",
        ];

        if ($this->hasErrors()) {
            $lines[] = '';
            $lines[] = 'Errors:';

            foreach (array_slice($this->errors, 0, $limit) as $error) {
                $lines[] = '- '.$error;
            }

            $remaining = count($this->errors) - $limit;

            if ($remaining > 0) {
                $lines[] = "...and {$remaining} more error(s).";
            }
        }

        return implode("\n", $lines);
    }
}