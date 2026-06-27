<?php

namespace App\Filament\Resources\SystemRoleResource\Pages;

use App\Filament\Resources\SystemRoleResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListSystemRoles extends ListRecords
{
    protected static string $resource = SystemRoleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
