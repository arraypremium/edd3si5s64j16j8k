<?php

namespace App\Filament\Resources\Members\Pages;

use App\Enums\Status;
use App\Filament\Resources\Members\MemberResource;
use App\Models\Member;
use App\Services\Members\MemberExcelService;
use Filament\Actions\Action;
use Filament\Actions\CreateAction;
use Filament\Forms\Components\FileUpload;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ListRecords;
use Filament\Schemas\Components\Tabs\Tab;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Storage;

class ListMembers extends ListRecords
{
    protected static string $resource = MemberResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('download_member_import_demo')
                ->label('Demo Import Excel')
                ->icon('heroicon-o-document-arrow-down')
                ->color('gray')
                ->action(fn () => app(MemberExcelService::class)->downloadDemoTemplate()),

            Action::make('export_members')
                ->label('Export Excel')
                ->icon('heroicon-o-arrow-down-tray')
                ->color('success')
                ->action(fn () => app(MemberExcelService::class)->downloadExport()),

            Action::make('import_members')
                ->label('Import Excel')
                ->icon('heroicon-o-arrow-up-tray')
                ->color('info')
                ->modalHeading('Import Members from Excel')
                ->modalDescription('Download the demo import Excel first. Required columns are marked with (required). Invalid rows will be skipped and valid rows will still be imported.')
                ->modalSubmitActionLabel('Analyze & Import')
                ->schema([
                    FileUpload::make('file')
                        ->label('Member Excel File (.xlsx)')
                        ->disk('local')
                        ->directory('imports/members')
                        ->acceptedFileTypes([
                            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                        ])
                        ->helperText('Only .xlsx files are supported. Required: Name, Email, Contact, Gender.')
                        ->maxSize(10240)
                        ->required(),
                ])
                ->action(function (array $data): void {
                    $file = $data['file'] ?? null;

                    if (! is_string($file) || $file === '') {
                        Notification::make()
                            ->title('Import failed')
                            ->body('Please upload a valid .xlsx file.')
                            ->danger()
                            ->send();

                        return;
                    }

                    $path = Storage::disk('local')->path($file);
                    $result = app(MemberExcelService::class)->import($path);
                    Storage::disk('local')->delete($file);

                    $notification = Notification::make()
                        ->body($result->summary());

                    if ($result->isSuccessful()) {
                        $notification
                            ->title('Members imported successfully')
                            ->success();
                    } elseif ($result->imported > 0) {
                        $notification
                            ->title('Members imported with skipped rows')
                            ->warning();
                    } else {
                        $notification
                            ->title('No members imported')
                            ->danger();
                    }

                    $notification->send();
                }),

            CreateAction::make()
                ->icon('heroicon-m-plus')
                ->label(__('app.actions.new', ['resource' => MemberResource::getModelLabel()]))
                ->hidden(! Member::exists()),
        ];
    }

    public function getTabs(): array
    {
        return [
            'all' => Tab::make(__('app.common.all')),
            'active' => Tab::make(__('app.status.active'))
                ->badge(Member::query()->where('status', 'active')->count())
                ->badgeColor(Status::Active->getColor())
                ->modifyQueryUsing(fn (Builder $query): Builder => $query->where('status', 'active')),
            'inactive' => Tab::make(__('app.status.inactive'))
                ->badge(Member::query()->where('status', 'inactive')->count())
                ->badgeColor(Status::Inactive->getColor())
                ->modifyQueryUsing(fn (Builder $query): Builder => $query->where('status', 'inactive')),
        ];
    }

    public function getBreadcrumbs(): array
    {
        return [
            __('app.navigation.groups.memberships'),
            MemberResource::getUrl('index') => MemberResource::getNavigationLabel(),
        ];
    }
}