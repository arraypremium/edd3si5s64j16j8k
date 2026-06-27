<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Filament\Resources\SystemRoleResource\Pages\CreateSystemRole;
use App\Filament\Resources\SystemRoleResource\Pages\EditSystemRole;
use App\Filament\Resources\SystemRoleResource\Pages\ListSystemRoles;
use App\Models\SystemAdmin;
use App\Models\SystemRole;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;
use Filament\Support\Enums\FontWeight;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;

class SystemRoleResource extends Resource
{
    protected static ?string $model = SystemRole::class;

    protected static ?string $navigationLabel = 'System Roles';

    protected static ?string $modelLabel = 'System Role';

    protected static ?string $pluralModelLabel = 'System Roles';

    protected static ?int $navigationSort = 1;

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
                                    ->label('Name')
                                    ->required()
                                    ->maxLength(255),

                                TextInput::make('label')
                                    ->label('Label')
                                    ->required()
                                    ->maxLength(255),

                                TextInput::make('guard_name')
                                    ->label('Guard Name')
                                    ->default('system_admin')
                                    ->disabled()
                                    ->dehydrated(false),
                            ])
                            ->columns([
                                'sm' => 2,
                                'lg' => 3,
                            ])
                            ->columnSpanFull(),
                    ])
                    ->columnSpanFull(),

                Tabs::make('System Role Assignments')
                    ->contained()
                    ->tabs([
                        Tab::make('administrators')
                            ->label('Administrators')
                            ->badge(SystemAdmin::query()->count())
                            ->schema([
                                CheckboxList::make('systemAdmins')
                                    ->hiddenLabel()
                                    ->relationship('systemAdmins', 'username')
                                    ->searchable()
                                    ->bulkToggleable()
                                    ->columns(2)
                                    ->helperText('Select which system_admin accounts should receive this system role.'),
                            ]),
                    ])
                    ->columnSpan('full'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->weight(FontWeight::Medium)
                    ->label('Name')
                    ->searchable(),

                TextColumn::make('guard_badge')
                    ->label('Guard Name')
                    ->state(fn (): string => 'system_admin')
                    ->badge()
                    ->color('warning'),

                TextColumn::make('system_admins_count')
                    ->label('Administrators')
                    ->counts('systemAdmins')
                    ->badge()
                    ->color('primary'),

                TextColumn::make('updated_at')
                    ->label('Updated At')
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

    public static function getPages(): array
    {
        return [
            'index' => ListSystemRoles::route('/'),
            'create' => CreateSystemRole::route('/create'),
            'edit' => EditSystemRole::route('/{record}/edit'),
        ];
    }

    private static function canManage(): bool
    {
        $user = auth()->user();

        return filament()->getCurrentPanel()?->getId() === 'system'
            && $user instanceof SystemAdmin;
    }
}
