<?php

namespace App\Filament\Resources\SystemAdminResource\Pages;

use App\Filament\Resources\SystemAdminResource;
use Filament\Resources\Pages\CreateRecord;

class CreateSystemAdmin extends CreateRecord
{
    protected static string $resource = SystemAdminResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    /**
     * Sync system roles after creating the admin.
     *
     * Defensive: skips if model doesn't have systemRoles() method
     * (graceful degradation for installations not yet migrated).
     */
    protected function afterCreate(): void
    {
        $roles = $this->data['systemRoles'] ?? [];

        if (empty($roles) || ! method_exists($this->record, 'systemRoles')) {
            return;
        }

        $this->record->systemRoles()->sync($roles);
    }
}
