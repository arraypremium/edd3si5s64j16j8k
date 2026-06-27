<?php

namespace App\Filament\Resources\GymSubscriptionResource\Pages;

use App\Filament\Resources\GymSubscriptionResource;
use App\Models\GymSubscription;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditGymSubscription extends EditRecord
{
    protected static string $resource = GymSubscriptionResource::class;

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $data['status'] = GymSubscription::deriveStatus(
            (string) $data['start_date'],
            (string) $data['end_date']
        );

        return $data;
    }

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make()
                ->successRedirectUrl(GymSubscriptionResource::getUrl('index')),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function afterSave(): void
    {
        $this->record->gym?->syncSubscriptionStatus();
    }
}
