<?php

namespace App\Filament\Resources\SystemPlanResource\Pages;

use App\Filament\Resources\SystemPlanResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListSystemPlans extends ListRecords
{
    protected static string $resource = SystemPlanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->icon('heroicon-o-plus'),
        ];
    }
}
