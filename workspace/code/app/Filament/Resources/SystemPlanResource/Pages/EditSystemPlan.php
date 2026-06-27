<?php

namespace App\Filament\Resources\SystemPlanResource\Pages;

use App\Filament\Resources\SystemPlanResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditSystemPlan extends EditRecord
{
    protected static string $resource = SystemPlanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make()
                ->successRedirectUrl(SystemPlanResource::getUrl('index')),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
