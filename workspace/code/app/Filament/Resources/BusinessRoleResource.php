<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Filament\Resources\BusinessRoleResource\Pages\CreateBusinessRole;
use App\Filament\Resources\BusinessRoleResource\Pages\EditBusinessRole;
use App\Filament\Resources\BusinessRoleResource\Pages\ListBusinessRoles;
use App\Models\SystemAdmin;
use BezhanSalleh\FilamentShield\Traits\HasShieldFormComponents;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Enums\FontWeight;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Unique;
use Spatie\Permission\Models\Role;

class BusinessRoleResource extends Resource
{
    use HasShieldFormComponents;

    protected static ?string $model = Role::class;

    protected static ?string $slug = 'shield/roles';

    protected static ?string $recordTitleAttribute = 'name';

    protected static ?string $navigationLabel = 'Roles';

    protected static ?string $modelLabel = 'Business Role';

    protected static ?string $pluralModelLabel = 'Business Roles';

    protected static ?int $navigationSort = 4;

    protected static bool $isScopedToTenant = false;

    public static function shouldRegisterNavigation(): bool
    {
        return filament()->getCurrentPanel()?->getId() === 'system';
    }

    public static function canAccess(): bool
    {
        return static::canManage();
    }

    public static function canViewAny(): bool
    {
        return static::canManage();
    }

    public static function canCreate(): bool
    {
        return static::canManage();
    }

    public static function canEdit(Model $record): bool
    {
        return static::canManage();
    }

    public static function canDelete(Model $record): bool
    {
        return static::canManage();
    }

    public static function getNavigationIcon(): ?string
    {
        return null;
    }

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Grid::make()
                    ->schema([
                        Section::make()
                            ->schema([
                                TextInput::make('name')
                                    ->label(__('filament-shield::filament-shield.field.name'))
                                    ->unique(
                                        ignoreRecord: true,
                                        modifyRuleUsing: fn (Unique $rule): Unique => $rule
                                            ->where('guard_name', 'web')
                                            ->whereNull('gym_id'),
                                    )
                                    ->required()
                                    ->maxLength(255),

                                TextInput::make('guard_name')
                                    ->label(__('filament-shield::filament-shield.field.guard_name'))
                                    ->default('web')
                                    ->dehydrateStateUsing(fn (): string => 'web')
                                    ->disabled()
                                    ->dehydrated()
                                    ->required()
                                    ->maxLength(255),

                                static::getSelectAllFormComponent(),
                            ])
                            ->columns([
                                'sm' => 2,
                                'lg' => 3,
                            ])
                            ->columnSpanFull(),
                    ])
                    ->columnSpanFull(),
                static::getShieldFormComponents(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->weight(FontWeight::Medium)
                    ->label(__('filament-shield::filament-shield.column.name'))
                    ->formatStateUsing(fn (string $state): string => Str::headline($state))
                    ->searchable(),

                TextColumn::make('guard_name')
                    ->badge()
                    ->color('warning')
                    ->label(__('filament-shield::filament-shield.column.guard_name')),

                TextColumn::make('permissions_count')
                    ->badge()
                    ->label(__('filament-shield::filament-shield.column.permissions'))
                    ->counts('permissions')
                    ->color('primary'),

                TextColumn::make('updated_at')
                    ->label(__('filament-shield::filament-shield.column.updated_at'))
                    ->dateTime(),
            ])
            ->filters([])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                DeleteBulkAction::make(),
            ]);
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->where('guard_name', 'web')
            ->whereNull('gym_id');
    }

    public static function getPages(): array
    {
        return [
            'index' => ListBusinessRoles::route('/'),
            'create' => CreateBusinessRole::route('/create'),
            'edit' => EditBusinessRole::route('/{record}/edit'),
        ];
    }

    /**
     * Keep Filament Shield permission form state out of the Spatie roles table.
     *
     * Shield adds resource, page, widget, and custom-permission keys to the form
     * so they can be synced to the role after persistence. Those keys are UI
     * state, not columns on the roles table, and must never be passed to
     * Role::create() or Role::update().
     *
     * @param  array<string, mixed>  $data
     * @return array{name: mixed, guard_name: string, gym_id: null}
     */
    public static function sanitizeRolePersistenceData(array $data): array
    {
        return [
            'name' => $data['name'] ?? null,
            'guard_name' => 'web',
            'gym_id' => null,
        ];
    }

    /**
     * Extract permission names from Shield form state without accepting arbitrary
     * strings from non-permission fields.
     *
     * @param  array<string, mixed>  $state
     * @return list<string>
     */
    public static function extractPermissionNamesFromFormState(array $state): array
    {
        return collect($state)
            ->except(['name', 'guard_name', 'gym_id', 'select_all'])
            ->flatten()
            ->filter(fn ($item): bool => is_string($item)
                && filled($item)
                && preg_match('/^[A-Za-z][A-Za-z0-9]*:[A-Za-z0-9][A-Za-z0-9]*$/', $item) === 1)
            ->unique()
            ->values()
            ->all();
    }

    /**
     * Extract permission names from multiple possible Filament/Livewire state
     * shapes while keeping the same strict permission-name filter.
     *
     * @param  array<int, array<string, mixed>>  $states
     * @return list<string>
     */
    public static function extractPermissionNamesFromStateSources(array ...$states): array
    {
        return collect($states)
            ->filter(fn (array $state): bool => $state !== [])
            ->flatMap(fn (array $state): array => static::extractPermissionNamesFromFormState($state))
            ->unique()
            ->values()
            ->all();
    }

    private static function canManage(): bool
    {
        $user = auth()->user();

        return filament()->getCurrentPanel()?->getId() === 'system'
            && $user instanceof SystemAdmin;
    }
}
