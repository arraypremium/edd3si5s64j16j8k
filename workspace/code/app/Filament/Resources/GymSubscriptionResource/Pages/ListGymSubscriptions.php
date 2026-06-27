<?php

namespace App\Filament\Resources\GymSubscriptionResource\Pages;

use App\Filament\Resources\GymSubscriptionResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListGymSubscriptions extends ListRecords
{
    protected static string $resource = GymSubscriptionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->icon('heroicon-o-plus'),
        ];
    }
}
