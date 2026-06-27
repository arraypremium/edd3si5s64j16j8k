<?php

namespace App\Filament\Concerns;

use App\Services\Excel\ResourceExcelService;
use Filament\Actions\Action;
use Filament\Actions\ActionGroup;
use Filament\Forms\Components\FileUpload;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Storage;

trait HasResourceExcelActions
{
    /**
     * Return Excel actions grouped into one dropdown so list-page headers remain
     * clean and usable on mobile screens.
     *
     * @return array<int, ActionGroup>
     */
    protected function excelHeaderActions(string $resource, string $label): array
    {
        return [
            ActionGroup::make([
                Action::make("download_{$resource}_import_demo")
                    ->label('Demo Import Excel')
                    ->icon('heroicon-o-document-arrow-down')
                    ->color('gray')
                    ->action(fn () => app(ResourceExcelService::class)->downloadDemo($resource)),

                Action::make("export_{$resource}")
                    ->label('Export Excel')
                    ->icon('heroicon-o-arrow-down-tray')
                    ->color('success')
                    ->action(fn () => app(ResourceExcelService::class)->downloadExport($resource, $this->getFilteredTableQuery())),

                Action::make("import_{$resource}")
                    ->label('Import Excel')
                    ->icon('heroicon-o-arrow-up-tray')
                    ->color('info')
                    ->modalHeading("Import {$label} from Excel")
                    ->modalDescription('Download the demo import Excel first. Required columns are marked with (required). Invalid rows will be skipped and valid rows will still be imported.')
                    ->modalSubmitActionLabel('Analyze & Import')
                    ->schema([
                        FileUpload::make('file')
                            ->label("{$label} Excel File (.xlsx)")
                            ->disk('local')
                            ->directory("imports/{$resource}")
                            ->acceptedFileTypes([
                                'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                            ])
                            ->helperText('Only .xlsx files are supported. Use the demo file format for best results.')
                            ->maxSize(10240)
                            ->required(),
                    ])
                    ->action(function (array $data) use ($resource, $label): void {
                        $file = $data['file'] ?? null;

                        if (is_array($file)) {
                            $file = reset($file) ?: null;
                        }

                        if (! is_string($file) || $file === '') {
                            Notification::make()
                                ->title('Import failed')
                                ->body('Please upload a valid .xlsx file.')
                                ->danger()
                                ->send();

                            return;
                        }

                        $path = Storage::disk('local')->path($file);
                        $result = app(ResourceExcelService::class)->import($resource, $path);
                        Storage::disk('local')->delete($file);

                        $notification = Notification::make()
                            ->body($result->summary());

                        if ($result->isSuccessful()) {
                            $notification
                                ->title("{$label} imported successfully")
                                ->success();
                        } elseif ($result->imported > 0) {
                            $notification
                                ->title("{$label} imported with skipped rows")
                                ->warning();
                        } else {
                            $notification
                                ->title("No {$label} imported")
                                ->danger();
                        }

                        $notification->send();
                    }),
            ])
                ->label('Excel')
                ->icon('heroicon-o-table-cells')
                ->color('gray')
                ->button(),
        ];
    }
}