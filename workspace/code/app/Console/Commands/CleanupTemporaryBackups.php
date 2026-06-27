<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class CleanupTemporaryBackups extends Command
{
    protected $signature = 'gymie:cleanup-backups {--hours=48 : Delete backup/export temporary files older than this many hours}';

    protected $description = 'Clean old temporary backup and Excel export files.';

    public function handle(): int
    {
        $hours = max((int) $this->option('hours'), 1);
        $cutoff = now()->subHours($hours)->getTimestamp();

        $directories = [
            storage_path('app/private/backups'),
            storage_path('app/private/exports'),
            storage_path('app/private/imports'),
            storage_path('app/private/livewire-tmp'),
        ];

        $deletedFiles = 0;
        $deletedDirectories = 0;

        foreach ($directories as $directory) {
            if (! is_dir($directory)) {
                continue;
            }

            foreach (File::allFiles($directory) as $file) {
                if ($file->getMTime() <= $cutoff) {
                    File::delete($file->getPathname());
                    $deletedFiles++;
                }
            }

            $iterator = new \RecursiveIteratorIterator(
                new \RecursiveDirectoryIterator($directory, \FilesystemIterator::SKIP_DOTS),
                \RecursiveIteratorIterator::CHILD_FIRST,
            );

            foreach ($iterator as $item) {
                if ($item->isDir()) {
                    $path = $item->getPathname();

                    if (@rmdir($path)) {
                        $deletedDirectories++;
                    }
                }
            }
        }

        $this->info("Deleted {$deletedFiles} old temporary file(s) and {$deletedDirectories} empty folder(s).");

        return self::SUCCESS;
    }
}