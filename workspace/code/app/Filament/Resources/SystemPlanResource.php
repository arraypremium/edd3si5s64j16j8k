<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SystemPlanResource\Pages;
use App\Models\SystemPlan;
use Filament\Actions\ActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Collection;

class SystemPlanResource extends Resource
{
    protected static ?string $model = SystemPlan::class;

    protected static ?string $recordTitleAttribute = 'name';

    protected static bool $isGloballySearchable = true;

    protected static ?string $navigationLabel = 'System Plan';

    protected static ?string $modelLabel = 'System Plan';

    protected static ?string $pluralModelLabel = 'System Plans';

    protected static ?int $navigationSort = 5;

    protected static bool $isScopedToTenant = false;

    public static function getNavigationIcon(): ?string
    {
        return null;
    }

    public static function shouldRegisterNavigation(): bool
    {
        return filament()->getCurrentPanel()?->getId() === 'system';
    }

    public static function canAccess(): bool
    {
        $user = auth()->user();

        return filament()->getCurrentPanel()?->getId() === 'system'
            && $user
            && method_exists($user, 'isSuperAdmin')
            && $user->isSuperAdmin();
    }

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->columns(1)
            ->components([
                Section::make('Plan Details')
                    ->description('Create plans that are assigned when onboarding businesses and their subscriptions.')
                    ->columnSpanFull()
                    ->schema([
                        TextInput::make('name')
                            ->label('Plan Name')
                            ->placeholder('e.g. Starter, Professional')
                            ->required()
                            ->maxLength(255),

                        TextInput::make('code')
                            ->label('Plan Code')
                            ->placeholder('e.g. STARTER')
                            ->required()
                            ->unique(SystemPlan::class, 'code', ignoreRecord: true)
                            ->maxLength(100)
                            ->prefixIcon('heroicon-m-hashtag'),

                        Textarea::make('description')
                            ->label('Description')
                            ->placeholder('Plan features and details...')
                            ->rows(3)
                            ->maxLength(1000)
                            ->columnSpanFull(),

                        TextInput::make('days')
                            ->label('Validity Period (Days)')
                            ->placeholder('30')
                            ->required()
                            ->numeric()
                            ->minValue(1)
                            ->maxValue(3650)
                            ->prefixIcon('heroicon-m-calendar'),

                        TextInput::make('amount')
                            ->label('Plan Price')
                            ->placeholder('999.00')
                            ->required()
                            ->numeric()
                            ->minValue(0)
                            ->prefix('₹'),

                        Select::make('status')
                            ->label('Status')
                            ->options([
                                'active' => 'Active',
                                'inactive' => 'Inactive',
                            ])
                            ->default('active')
                            ->required(),
                    ])
                    ->columns(1),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->label('ID')
                    ->sortable()
                    ->weight('bold')
                    ->toggleable(isToggledHiddenByDefault: false),

                TextColumn::make('name')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),

                TextColumn::make('code')
                    ->searchable()
                    ->sortable()
                    ->fontFamily('mono')
                    ->color('gray'),

                TextColumn::make('amount')
                    ->sortable()
                    ->prefix('₹')
                    ->numeric(decimalPlaces: 2),

                TextColumn::make('days')
                    ->sortable()
                    ->suffix(' days'),

                TextColumn::make('status')
                    ->badge(),

                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->visibleFrom('md'),
            ])
            ->filters([])
            ->recordActions([
                ActionGroup::make([
                    ViewAction::make(),
                    EditAction::make(),
                    DeleteAction::make(),
                ])
                    ->label('Actions')
                    ->icon('heroicon-m-ellipsis-vertical')
                    ->color('gray')
                    ->button(),
            ])
            ->toolbarActions([
                \Filament\Actions\BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    \Filament\Actions\BulkAction::make('activate')
                        ->label('Activate')
                        ->icon('heroicon-o-play')
                        ->color('success')
                        ->requiresConfirmation()
                        ->action(fn (Collection $records) => $records->each->update(['status' => 'active'])),
                    \Filament\Actions\BulkAction::make('deactivate')
                        ->label('Deactivate')
                        ->icon('heroicon-o-x-mark')
                        ->color('danger')
                        ->requiresConfirmation()
                        ->action(fn (Collection $records) => $records->each->update(['status' => 'inactive'])),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSystemPlans::route('/'),
            'create' => Pages\CreateSystemPlan::route('/create'),
            'edit' => Pages\EditSystemPlan::route('/{record}/edit'),
        ];
    }
}
