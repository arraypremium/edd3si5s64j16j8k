<?php

namespace App\Filament\Resources\SystemAdminResource\Pages;

use App\Filament\Resources\SystemAdminResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListSystemAdmins extends ListRecords
{
    protected static string $resource = SystemAdminResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->icon('heroicon-o-plus'),
        ];
    }
}
