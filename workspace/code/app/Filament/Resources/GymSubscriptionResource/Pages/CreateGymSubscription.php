<?php

namespace App\Filament\Resources\GymSubscriptionResource\Pages;

use App\Filament\Resources\GymSubscriptionResource;
use App\Models\GymSubscription;
use Filament\Resources\Pages\CreateRecord;

class CreateGymSubscription extends CreateRecord
{
    protected static string $resource = GymSubscriptionResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['status'] = GymSubscription::deriveStatus(
            (string) $data['start_date'],
            (string) $data['end_date']
        );

        return $data;
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function afterCreate(): void
    {
        $this->record->gym?->syncSubscriptionStatus();
    }
}
