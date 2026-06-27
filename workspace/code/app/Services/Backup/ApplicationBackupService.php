<?php

namespace App\Services\Backup;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use OpenSpout\Common\Entity\Row;
use OpenSpout\Writer\XLSX\Writer;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Throwable;
use ZipArchive;

class ApplicationBackupService
{
    /** @var list<string> */
    private array $excludedTables = [
        'cache',
        'cache_locks',
        'sessions',
        'jobs',
        'job_batches',
        'failed_jobs',
    ];

    public function downloadBackupZip(): BinaryFileResponse
    {
        $timestamp = now()->format('Y-m-d-His');
        $baseDirectory = storage_path("app/private/backups/gymie-backup-{$timestamp}");
        $excelDirectory = $baseDirectory.'/excel';
        $filesDirectory = $baseDirectory.'/files';
        $zipPath = storage_path("app/private/backups/gymie-full-backup-{$timestamp}.zip");

        try {
            File::ensureDirectoryExists($excelDirectory);
            File::ensureDirectoryExists($filesDirectory);

            $tables = $this->tables();
            $sqlPath = $baseDirectory.'/database.sql';
            file_put_contents($sqlPath, $this->databaseSql($tables));

            foreach ($tables as $table) {
                $this->writeTableExcel($table, $excelDirectory."/{$table}.xlsx");
            }

            $this->copyIfExists(storage_path('data/settingsData.json'), $baseDirectory.'/storage-data/settingsData.json');
            $this->copyIfExists(storage_path('data/settingsData.json.example'), $baseDirectory.'/storage-data/settingsData.json.example');
            $this->copyDirectoryIfExists(storage_path('app/public'), $filesDirectory.'/public');

            $this->zipDirectory($baseDirectory, $zipPath);
        } finally {
            if (is_dir($baseDirectory)) {
                File::deleteDirectory($baseDirectory);
            }
        }

        return response()
            ->download($zipPath, "gymie-full-backup-{$timestamp}.zip")
            ->deleteFileAfterSend(true);
    }

    /**
     * Import backup from a .zip containing database.sql or from a direct .sql file.
     * SQL import is used because it preserves IDs, relationships, users, roles,
     * permissions, invoices, transactions, settings references, and unique data.
     *
     * @return array{success: bool, message: string}
     */
    public function importBackup(string $filePath): array
    {
        if (! is_file($filePath)) {
            return ['success' => false, 'message' => 'Backup file was not found.'];
        }

        $extension = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));
        $workingDirectory = storage_path('app/private/backups/import-'.now()->format('YmdHis').'-'.bin2hex(random_bytes(4)));

        File::ensureDirectoryExists($workingDirectory);

        try {
            if ($extension === 'zip') {
                $zip = new ZipArchive();

                if ($zip->open($filePath) !== true) {
                    return ['success' => false, 'message' => 'Could not open backup zip file.'];
                }

                $zip->extractTo($workingDirectory);
                $zip->close();

                $sqlPath = $workingDirectory.'/database.sql';
            } elseif ($extension === 'sql') {
                $sqlPath = $filePath;
            } else {
                return ['success' => false, 'message' => 'Only .zip backup files or .sql files can be imported.'];
            }

            if (! is_file($sqlPath)) {
                return ['success' => false, 'message' => 'database.sql was not found in the backup.'];
            }

            $this->runSqlFile($sqlPath);

            if (is_file($workingDirectory.'/storage-data/settingsData.json')) {
                File::ensureDirectoryExists(storage_path('data'));
                copy($workingDirectory.'/storage-data/settingsData.json', storage_path('data/settingsData.json'));
            }

            if (is_dir($workingDirectory.'/files/public')) {
                File::ensureDirectoryExists(storage_path('app/public'));
                File::copyDirectory($workingDirectory.'/files/public', storage_path('app/public'));
            }

            return ['success' => true, 'message' => 'Backup imported successfully. Clear cache and log in again if needed.'];
        } catch (Throwable $exception) {
            return ['success' => false, 'message' => 'Backup import failed: '.$exception->getMessage()];
        } finally {
            if (is_dir($workingDirectory)) {
                File::deleteDirectory($workingDirectory);
            }
        }
    }

    /**
     * @return list<string>
     */
    private function tables(): array
    {
        $database = DB::getDatabaseName();

        $rows = DB::select('SHOW FULL TABLES WHERE Table_type = "BASE TABLE"');
        $key = 'Tables_in_'.$database;

        return collect($rows)
            ->map(function (object $row) use ($key): string {
                $values = (array) $row;

                return (string) ($values[$key] ?? reset($values));
            })
            ->reject(fn (string $table): bool => in_array($table, $this->excludedTables, true))
            ->values()
            ->all();
    }

    /**
     * @param  list<string>  $tables
     */
    private function databaseSql(array $tables): string
    {
        $sql = [];

        $sql[] = '-- Gymie full SQL backup';
        $sql[] = '-- Generated at '.now()->toDateTimeString();
        $sql[] = 'SET FOREIGN_KEY_CHECKS=0;';
        $sql[] = 'SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";';
        $sql[] = '';

        foreach ($tables as $table) {
            $sql[] = "DELETE FROM `{$table}`;";
        }

        $sql[] = '';

        foreach ($tables as $table) {
            $columns = $this->columns($table);

            if ($columns === []) {
                continue;
            }

            DB::table($table)
                ->orderBy($columns[0])
                ->chunk(500, function ($rows) use (&$sql, $table, $columns): void {
                    foreach ($rows as $row) {
                        $values = [];

                        foreach ($columns as $column) {
                            $values[] = $this->sqlValue($row->{$column} ?? null);
                        }

                        $columnSql = implode(
                            ', ',
                            array_map(fn (string $column): string => "`{$column}`", $columns),
                        );

                        $valueSql = implode(', ', $values);

                        $sql[] = "INSERT INTO `{$table}` ({$columnSql}) VALUES ({$valueSql});";
                    }
                });
        }

        $sql[] = '';
        $sql[] = 'SET FOREIGN_KEY_CHECKS=1;';
        $sql[] = '';

        return implode("\n", $sql);
    }

    /**
     * @return list<string>
     */
    private function columns(string $table): array
    {
        return collect(DB::select("SHOW COLUMNS FROM `{$table}`"))
            ->map(fn (object $column): string => (string) $column->Field)
            ->values()
            ->all();
    }

    private function sqlValue(mixed $value): string
    {
        if ($value === null) {
            return 'NULL';
        }

        if (is_bool($value)) {
            return $value ? '1' : '0';
        }

        $value = (string) $value;

        $value = str_replace(
            ["\\", "\0", "\n", "\r", "\x1a", "'"],
            ["\\\\", "\\0", "\\n", "\\r", "\\Z", "\\'"],
            $value,
        );

        return "'{$value}'";
    }

    private function writeTableExcel(string $table, string $filePath): void
    {
        $columns = $this->columns($table);

        $writer = new Writer();
        $writer->openToFile($filePath);

        $writer->addRow(Row::fromValues($columns));

        if ($columns !== []) {
            DB::table($table)
                ->orderBy($columns[0])
                ->chunk(500, function ($rows) use ($writer, $columns): void {
                    foreach ($rows as $row) {
                        $writer->addRow(Row::fromValues(array_map(
                            fn (string $column): mixed => $row->{$column} ?? null,
                            $columns,
                        )));
                    }
                });
        }

        $writer->close();
    }

    private function runSqlFile(string $sqlPath): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');

        $handle = fopen($sqlPath, 'rb');

        if ($handle === false) {
            throw new \RuntimeException('Could not read SQL file.');
        }

        try {
            $statement = '';

            while (($line = fgets($handle)) !== false) {
                $trimmed = trim($line);

                if ($trimmed === '' || str_starts_with($trimmed, '--')) {
                    continue;
                }

                $statement .= $line;

                if (str_ends_with($trimmed, ';')) {
                    DB::unprepared(rtrim($statement, "; \r\n\t"));
                    $statement = '';
                }
            }

            if (trim($statement) !== '') {
                DB::unprepared($statement);
            }
        } finally {
            fclose($handle);

            DB::statement('SET FOREIGN_KEY_CHECKS=1');
        }
    }

    private function copyIfExists(string $from, string $to): void
    {
        if (! is_file($from)) {
            return;
        }

        File::ensureDirectoryExists(dirname($to));
        copy($from, $to);
    }

    private function copyDirectoryIfExists(string $from, string $to): void
    {
        if (! is_dir($from)) {
            return;
        }

        File::ensureDirectoryExists(dirname($to));
        File::copyDirectory($from, $to);
    }

    private function zipDirectory(string $sourceDirectory, string $zipPath): void
    {
        File::ensureDirectoryExists(dirname($zipPath));

        $zip = new ZipArchive();

        if ($zip->open($zipPath, ZipArchive::CREATE | ZipArchive::OVERWRITE) !== true) {
            throw new \RuntimeException('Could not create backup zip file.');
        }

        $files = new \RecursiveIteratorIterator(
            new \RecursiveDirectoryIterator($sourceDirectory, \FilesystemIterator::SKIP_DOTS),
            \RecursiveIteratorIterator::SELF_FIRST,
        );

        foreach ($files as $file) {
            $filePath = $file->getPathname();
            $relativePath = substr($filePath, strlen($sourceDirectory) + 1);

            if ($file->isDir()) {
                $zip->addEmptyDir($relativePath);
            } else {
                $zip->addFile($filePath, $relativePath);
            }
        }

        $zip->close();
    }
}