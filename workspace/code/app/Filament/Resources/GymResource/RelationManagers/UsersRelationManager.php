<?php

namespace App\Filament\Resources\GymResource\RelationManagers;

use App\Models\Gym;
use App\Models\User;
use App\Support\Roles\BusinessRoleManager;
use Filament\Actions\Action;
use Filament\Actions\ActionGroup;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\DetachAction;
use Filament\Actions\DetachBulkAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsersRelationManager extends RelationManager
{
    protected static string $relationship = 'facilityStaff';

    protected static ?string $title = 'Assigned Facility Staff & Owners';

    protected static ?string $recordTitleAttribute = 'username';

    public function table(Table $table): Table
    {
        return $table
            ->defaultSort('users.id', 'desc')
            ->columns([
                TextColumn::make('name')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),

                TextColumn::make('username')
                    ->label('Username')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('role')
                    ->label('Assigned Role')
                    ->badge()
                    ->formatStateUsing(fn (?string $state): string => filled($state) ? Str::headline($state) : '—'),

                TextColumn::make('status')
                    ->badge()
                    ->color(fn ($state): string => match ($state instanceof \App\Enums\Status ? $state->value : (string) $state) {
                        'active' => 'success',
                        'inactive' => 'danger',
                        default => 'gray',
                    }),
            ])
            ->filters([])
            ->headerActions([
                Action::make('attachFacilityUser')
                    ->label('Attach Facility User')
                    ->icon('heroicon-o-link')
                    ->form([
                        Select::make('user_id')
                            ->label('User')
                            ->options(fn (): array => User::query()
                                ->facilityUsers()
                                ->orderBy('username')
                                ->pluck('username', 'id')
                                ->all())
                            ->searchable()
                            ->preload()
                            ->required(),
                        Select::make('role')
                            ->label('Role')
                            ->options(fn (): array => BusinessRoleManager::options())
                            ->searchable()
                            ->preload()
                            ->required(),
                    ])
                    ->action(function (array $data): void {
                        /** @var Gym $gym */
                        $gym = $this->getOwnerRecord();
                        $user = User::query()->findOrFail((int) $data['user_id']);

                        BusinessRoleManager::assignUserToGymRole($user, $gym, (string) $data['role']);
                    }),

                Action::make('createFacilityUser')
                    ->label('Create Facility User')
                    ->icon('heroicon-o-user-plus')
                    ->form([
                        TextInput::make('name')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('username')
                            ->label('Username')
                            ->required()
                            ->unique(User::class, 'username')
                            ->maxLength(255),
                        TextInput::make('password')
                            ->password()
                            ->revealable()
                            ->required(),
                        Select::make('role')
                            ->label('Role')
                            ->options(fn (): array => BusinessRoleManager::options())
                            ->searchable()
                            ->preload()
                            ->required(),
                    ])
                    ->action(function (array $data): void {
                        /** @var Gym $gym */
                        $gym = $this->getOwnerRecord();

                        $user = User::create([
                            'name' => $data['name'],
                            'username' => $data['username'],
                            'password' => Hash::make((string) $data['password']),
                            'status' => 'active',
                        ]);

                        BusinessRoleManager::assignUserToGymRole($user, $gym, (string) $data['role']);
                    }),
            ])
            ->recordActions([
                ActionGroup::make([
                    ViewAction::make(),
                    Action::make('editAssignment')
                        ->label('Edit')
                        ->icon('heroicon-m-pencil-square')
                        ->fillForm(fn (User $record): array => [
                            'name' => $record->name,
                            'username' => $record->username,
                            'role' => BusinessRoleManager::currentRoleName($record, $this->getOwnerRecord()) ?? $record->pivot?->role,
                        ])
                        ->form([
                            TextInput::make('name')
                                ->required()
                                ->maxLength(255),
                            TextInput::make('username')
                                ->label('Username')
                                ->required()
                                ->unique(User::class, 'username', ignoreRecord: true)
                                ->maxLength(255),
                            TextInput::make('password')
                                ->password()
                                ->revealable(),
                            Select::make('role')
                                ->label('Role')
                                ->options(fn (): array => BusinessRoleManager::options())
                                ->searchable()
                                ->preload()
                                ->required(),
                        ])
                        ->action(function (User $record, array $data): void {
                            /** @var Gym $gym */
                            $gym = $this->getOwnerRecord();

                            $payload = [
                                'name' => $data['name'],
                                'username' => $data['username'],
                            ];

                            if (filled($data['password'] ?? null)) {
                                $payload['password'] = Hash::make((string) $data['password']);
                            }

                            $record->update($payload);

                            BusinessRoleManager::assignUserToGymRole($record, $gym, (string) $data['role']);
                        }),
                    DetachAction::make(),
                    DeleteAction::make(),
                ])
                    ->label('Actions')
                    ->icon('heroicon-m-ellipsis-vertical')
                    ->color('gray')
                    ->button(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DetachBulkAction::make(),
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
