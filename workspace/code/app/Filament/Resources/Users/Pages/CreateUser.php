<?php

namespace App\Filament\Resources\Users\Pages;

use App\Filament\Resources\Users\UserResource;
use App\Models\Gym;
use App\Support\Roles\BusinessRoleManager;
use Filament\Facades\Filament;
use Filament\Resources\Pages\CreateRecord;

class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;

    protected ?string $selectedRole = null;

    protected ?int $selectedGymId = null;

    public function getTitle(): string
    {
        return __('app.actions.new', ['resource' => UserResource::getModelLabel()]);
    }

    public function getBreadcrumbs(): array
    {
        return [
            __('app.navigation.groups.administration'),
            UserResource::getUrl('index') => UserResource::getNavigationLabel(),
        ];
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $this->selectedRole = filled($data['role'] ?? null) ? (string) $data['role'] : null;
        $this->selectedGymId = filled($data['gym_id'] ?? null) ? (int) $data['gym_id'] : null;

        unset($data['role'], $data['gym_id']);

        return $data;
    }

    protected function afterCreate(): void
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
            return $this->selectedGymId ? Gym::query()->find($this->selectedGymId) : null;
        }

        $tenant = Filament::getTenant();

        return $tenant instanceof Gym ? $tenant : null;
    }
}
