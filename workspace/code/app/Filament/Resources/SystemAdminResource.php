<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SystemAdminResource\Pages;
use App\Models\SystemAdmin;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Illuminate\Support\Facades\Hash;

class SystemAdminResource extends Resource
{
    protected static ?string $model = SystemAdmin::class;

    protected static ?string $navigationLabel = 'Administrators';

    protected static ?string $modelLabel = 'System Admin';

    protected static ?string $pluralModelLabel = 'System Admins';

    protected static ?int $navigationSort = 4;

    protected static bool $isScopedToTenant = false;

    public static function getNavigationIcon(): string
    {
        return 'heroicon-o-shield-check';
    }

    /**
     * Ensure this resource only appears in the System Super Admin Panel.
     */
    public static function shouldRegisterNavigation(): bool
    {
        return filament()->getCurrentPanel()?->getId() === 'system';
    }

    public static function canAccess(): bool
    {
        return filament()->getCurrentPanel()?->getId() === 'system';
    }

    /**
     * Configure the system admin editing schema.
     */
    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Administrator Account Details')
                    ->description('Master system administrator credentials and operational access.')
                    ->schema([
                        TextInput::make('name')
                            ->required()
                            ->maxLength(255),

                        TextInput::make('username')
                            ->required()
                            ->maxLength(255)
                            ->unique(SystemAdmin::class, 'username', ignoreRecord: true),

                        Select::make('status')
                            ->options([
                                'active' => 'Active',
                                'inactive' => 'Inactive',
                            ])
                            ->default('active')
                            ->required(),

                        TextInput::make('password')
                            ->password()
                            ->dehydrateStateUsing(fn ($state) => filled($state) ? $state : null)
                            ->dehydrated(fn ($state) => filled($state))
                            ->required(fn (string $operation): bool => $operation === 'create')
                            ->revealable()
                            ->maxLength(255),
                    ])
                    ->columns(['default' => 1, 'sm' => 2]),

                Section::make('System Role Assignments')
                    ->description('Assign system-level roles (decoupled from facility roles).')
                    ->schema([
                        Select::make('systemRoles')
                            ->label('System Roles')
                            // Defensive: only show if model has the relationship + table exists
                            ->relationship(
                                name: 'systemRoles',
                                titleAttribute: 'label',
                                modifyQueryUsing: fn ($query) => $query
                                    ->whereRaw('1=1') // placeholder
                            )
                            ->multiple()
                            ->preload()
                            ->searchable()
                            ->helperText('These roles are independent of facility-level Spatie roles.')
                            ->hidden(! \Illuminate\Support\Facades\Schema::hasTable('system_roles'))
                            ->columnSpanFull(),
                    ]),
            ]);
    }

    /**
     * Configure the master system admin management table.
     */
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),

                TextColumn::make('username')
                    ->searchable()
                    ->sortable()
                    ->fontFamily('mono')
                    ->color('gray'),

                TextColumn::make('status')
                    ->badge()
                    ->color(fn ($state): string => match ($state instanceof \App\Enums\Status ? $state->value : (string) $state) {
                        'active' => 'success',
                        'inactive' => 'danger',
                        default => 'gray',
                    }),

                TextColumn::make('systemRoles.label')
                    ->label('System Roles')
                    ->badge()
                    ->separator(', '),

                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([])
            ->actions([
                EditAction::make(),
                DeleteAction::make(),
            ]);
    }

    /**
     * Map supporting resource execution pages.
     */
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSystemAdmins::route('/'),
            'create' => Pages\CreateSystemAdmin::route('/create'),
            'edit' => Pages\EditSystemAdmin::route('/{record}/edit'),
        ];
    }
}
