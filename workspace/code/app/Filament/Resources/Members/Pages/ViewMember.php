<?php

namespace App\Filament\Resources\Members\Pages;

use App\Filament\Resources\Members\MemberResource;
use App\Models\Member;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

/**
 * @property-read Member $record
 */
class ViewMember extends ViewRecord
{
    protected static string $resource = MemberResource::class;

    public function mount(int|string $record): void
    {
        parent::mount($record);

        abort_if($this->record->trashed(), 404);
    }

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
            DeleteAction::make()
                ->using(fn (Member $record): bool => (bool) $record->forceDelete()),
        ];
    }

    public function getTitle(): string
    {
        return __('app.titles.record', [
            'resource' => MemberResource::getModelLabel(),
            'name' => $this->record->name,
        ]);
    }

    public function getBreadcrumbs(): array
    {
        return [
            __('app.navigation.groups.memberships'),
            MemberResource::getUrl('index') => MemberResource::getNavigationLabel(),
            $this->record->name,
        ];
    }
}