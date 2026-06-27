<?php

namespace App\Filament\Resources\BusinessRoleResource\Pages;

use App\Filament\Resources\BusinessRoleResource;
use Filament\Resources\Pages\CreateRecord;
use Spatie\Permission\Models\Permission;

class CreateBusinessRole extends CreateRecord
{
    protected static string $resource = BusinessRoleResource::class;

    /**
     * @var list<string>
     */
    protected array $capturedPermissionNames = [];

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $this->capturedPermissionNames = BusinessRoleResource::extractPermissionNamesFromFormState($data);

        return BusinessRoleResource::sanitizeRolePersistenceData($data);
    }

    protected function afterCreate(): void
    {
        $guard = $this->record->guard_name ?? 'web';

        $permissions = collect($this->resolvePermissionNames())->map(function (string $name) use ($guard) {
            return Permission::firstOrCreate([
                'name' => $name,
                'guard_name' => $guard,
            ]);
        });

        $this->record->syncPermissions($permissions);
    }

    /**
     * @return list<string>
     */
    protected function resolvePermissionNames(): array
    {
        if ($this->capturedPermissionNames !== []) {
            return $this->capturedPermissionNames;
        }

        return BusinessRoleResource::extractPermissionNamesFromStateSources(
            ...$this->permissionStateFallbackSources()
        );
    }

    /**
     * @return array<int, array<string, mixed>>
     */
    protected function permissionStateFallbackSources(): array
    {
        $sources = [];

        if (property_exists($this, 'data') && is_array($this->data)) {
            $sources[] = $this->data;
            $sources[] = ['data' => $this->data];
        }

        try {
            $rawState = $this->form->getRawState();

            if ($rawState instanceof \Illuminate\Contracts\Support\Arrayable) {
                $rawState = $rawState->toArray();
            }

            if (is_array($rawState)) {
                $sources[] = $rawState;
            }
        } catch (\Throwable) {
            // Some Filament form states are not readable after persistence.
        }

        try {
            $state = $this->form->getState();

            if (is_array($state)) {
                $sources[] = $state;
            }
        } catch (\Throwable) {
            // Validation or dehydration may make this unavailable after create.
        }

        return $sources;
    }
}
