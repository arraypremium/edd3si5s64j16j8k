<?php

namespace App\Filament\Resources\BusinessRoleResource\Pages;

use App\Filament\Resources\BusinessRoleResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListBusinessRoles extends ListRecords
{
    protected static string $resource = BusinessRoleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
