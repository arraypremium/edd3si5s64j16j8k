<?php

namespace App\Filament\Resources\Users\Pages;

use App\Filament\Resources\Users\UserResource;
use App\Models\Gym;
use App\Models\User;
use App\Support\Roles\BusinessRoleManager;
use Filament\Actions\DeleteAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Actions\ViewAction;
use Filament\Facades\Filament;
use Filament\Resources\Pages\EditRecord;

/**
 * @property-read User $record
 */
class EditUser extends EditRecord
{
    protected static string $resource = UserResource::class;

    protected ?string $selectedRole = null;

    protected ?int $selectedGymId = null;

    public function getTitle(): string
    {
        return __('app.actions.edit', ['resource' => UserResource::getModelLabel()]);
    }

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
            ForceDeleteAction::make(),
            RestoreAction::make(),
        ];
    }

    public function getBreadcrumbs(): array
    {
        return [
            __('app.navigation.groups.administration'),
            UserResource::getUrl('index') => UserResource::getNavigationLabel(),
            $this->record->name,
        ];
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $this->selectedRole = filled($data['role'] ?? null) ? (string) $data['role'] : null;
        $this->selectedGymId = filled($data['gym_id'] ?? null) ? (int) $data['gym_id'] : null;

        unset($data['role'], $data['gym_id']);

        return $data;
    }

    protected function afterSave(): void
    {
        if (! $this->selectedRole) {
            return;
        }

        $gym = $this->resolveGym();

        if (! $gym) {
            return;
        }

        BusinessRoleManager::assignUserToGymRole($this->record, $gym, $this->selectedRole);
    }

    private function resolveGym(): ?Gym
    {
        if (filament()->getCurrentPanel()?->getId() === 'system') {
            return $this->selectedGymId
                ? Gym::query()->find($this->selectedGymId)
                : BusinessRoleManager::firstGym($this->record);
        }

        $tenant = Filament::getTenant();

        return $tenant instanceof Gym ? $tenant : null;
    }
}
