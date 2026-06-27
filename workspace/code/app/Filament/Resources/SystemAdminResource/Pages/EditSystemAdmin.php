<?php

namespace App\Filament\Resources\SystemAdminResource\Pages;

use App\Filament\Resources\SystemAdminResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditSystemAdmin extends EditRecord
{
    protected static string $resource = SystemAdminResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make()
                ->successRedirectUrl(SystemAdminResource::getUrl('index')),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    /**
     * Sync system roles after saving the admin.
     *
     * Defensive: skips if model doesn't have systemRoles() method
     * (graceful degradation for installations not yet migrated).
     */
    protected function afterSave(): void
    {
        $roles = $this->data['systemRoles'] ?? [];

        if (empty($roles) || ! method_exists($this->record, 'systemRoles')) {
            return;
        }

        $this->record->systemRoles()->sync($roles);
    }
}
