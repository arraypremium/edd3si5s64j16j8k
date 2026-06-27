<?php

namespace App\Filament\Resources\Services\Pages;

use App\Filament\Concerns\HasResourceExcelActions;
use App\Filament\Resources\Services\ServiceResource;
use App\Models\Service;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListServices extends ListRecords
{
    use HasResourceExcelActions;

    protected static string $resource = ServiceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ...$this->excelHeaderActions('services', 'Services'),

            CreateAction::make()
                ->icon('heroicon-m-plus')
                ->label(__('app.actions.new', ['resource' => ServiceResource::getModelLabel()]))
                ->modalHeading(__('app.actions.new', ['resource' => ServiceResource::getModelLabel()]))
                ->modalWidth('sm')
                ->createAnother(false)
                ->visible(Service::exists()),
        ];
    }

    public function getBreadcrumbs(): array
    {
        return [
            __('app.navigation.groups.memberships'),
            ServiceResource::getNavigationLabel(),
        ];
    }
}