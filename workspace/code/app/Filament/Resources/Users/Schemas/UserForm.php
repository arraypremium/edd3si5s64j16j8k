<?php

namespace App\Filament\Resources\Users\Schemas;

use App\Models\Gym;
use App\Support\Roles\BusinessRoleManager;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(1)
            ->components([
                Section::make('User Account Details')
                    ->description('Manage facility users and assign one site-admin-created role.')
                    ->schema([
                        TextInput::make('name')
                            ->label(__('app.fields.name'))
                            ->required()
                            ->placeholder(__('app.placeholders.example_full_name')),

                        TextInput::make('username')
                            ->label('Username')
                            ->required()
                            ->placeholder('e.g. admin_owner')
                            ->unique(ignorable: fn ($record) => $record)
                            ->prefixIcon('heroicon-m-user'),

                        Select::make('gym_id')
                            ->label('Business')
                            ->options(fn (): array => Gym::query()->orderBy('name')->pluck('name', 'id')->all())
                            ->searchable()
                            ->preload()
                            ->visible(fn (): bool => filament()->getCurrentPanel()?->getId() === 'system')
                            ->required(fn (): bool => filament()->getCurrentPanel()?->getId() === 'system')
                            ->afterStateHydrated(function (Select $component, $record): void {
                                if (! $record || filled($component->getState())) {
                                    return;
                                }

                                $component->state($record->gyms()->orderBy('gyms.id')->value('gyms.id'));
                            }),

                        Select::make('status')
                            ->label(__('app.fields.status'))
                            ->options([
                                'active' => __('app.status.active'),
                                'inactive' => __('app.status.inactive'),
                            ])
                            ->default('active')
                            ->required()
                            ->selectablePlaceholder(false),

                        Select::make('role')
                            ->label(__('app.fields.role'))
                            ->helperText('Create and manage roles in /system/shield/roles.')
                            ->options(fn (): array => BusinessRoleManager::options())
                            ->searchable()
                            ->preload()
                            ->required()
                            ->afterStateHydrated(function (Select $component, $record): void {
                                if (! $record) {
                                    return;
                                }

                                $roleName = BusinessRoleManager::currentRoleName($record);

                                if ($roleName) {
                                    $component->state($roleName);
                                }
                            }),

                        TextInput::make('password')
                            ->label(__('app.fields.password'))
                            ->password()
                            ->hiddenOn(['view'])
                            ->dehydrated(fn ($state) => filled($state))
                            ->required(fn (string $operation): bool => $operation === 'create')
                            ->revealable(),

                        TextInput::make('password_confirmation')
                            ->label(__('app.fields.password_confirmation'))
                            ->password()
                            ->hiddenOn(['view'])
                            ->revealable()
                            ->required(fn (callable $get): bool => filled($get('password')))
                            ->same('password'),
                    ])
                    ->columns(['default' => 1, 'sm' => 2]),
            ]);
    }
}
