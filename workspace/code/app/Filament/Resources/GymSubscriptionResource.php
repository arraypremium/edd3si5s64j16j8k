<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GymSubscriptionResource\Pages;
use App\Models\Gym;
use App\Models\GymSubscription;
use App\Models\SystemPlan;
use Filament\Actions\ActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class GymSubscriptionResource extends Resource
{
    protected static ?string $model = GymSubscription::class;

    protected static ?string $recordTitleAttribute = null;

    protected static bool $isGloballySearchable = false;

    protected static ?string $navigationLabel = 'Subscriptions';

    protected static ?string $modelLabel = 'Gym Subscription';

    protected static ?string $pluralModelLabel = 'Gym Subscriptions';

    protected static ?int $navigationSort = 3;

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

    public static function getNavigationBadge(): ?string
    {
        // NOTE: status column still exists in DB – used for badge count
        // Will be phased out in Problem 5D
        return static::getModel()::query()
            ->where('end_date', '<=', now()->addDays(7)->toDateString())
            ->where('end_date', '>=', now()->toDateString())
            ->count();
    }

    public static function getNavigationBadgeColor(): ?string
    {
        return 'warning';
    }

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->columns(1)
            ->components([
                Section::make('Subscription Details')
                    ->description('Assign a system plan to a gym facility.')
                    ->columnSpanFull()
                    ->schema([
                        // Problem 5B – Gym facility auto-detected by ID, show ID + Name
                        Select::make('gym_id')
                            ->label('Gym Facility')
                            ->options(fn () => Gym::query()
                                ->orderBy('assigned_id')
                                ->get()
                                ->mapWithKeys(fn ($g) => [
                                    $g->id => trim(
                                        ($g->assigned_id ? str_pad($g->assigned_id, 6, '0', STR_PAD_LEFT) . ' – ' : '#'.$g->id.' – ')
                                        . $g->name
                                    )
                                ])
                                ->toArray()
                            )
                            ->searchable()
                            ->preload()
                            ->required()
                            ->helperText('Facility is linked by ID'),

                        Select::make('system_plan_id')
                            ->label('System Plan')
                            ->options(fn () => SystemPlan::active()->pluck('name', 'id'))
                            ->searchable()
                            ->required()
                            ->live()
                            ->afterStateUpdated(function (callable $set, $state) {
                                $plan = SystemPlan::find($state);
                                if ($plan) {
                                    $set('start_date', now()->toDateString());
                                    $set('end_date', now()->addDays($plan->days)->toDateString());
                                }
                            }),

                        DatePicker::make('start_date')
                            ->label('Start Date')
                            ->required()
                            ->default(now())
                            ->live()
                            ->afterStateUpdated(function (callable $set, $get) {
                                $plan = SystemPlan::find($get('system_plan_id'));
                                if ($plan && $get('start_date')) {
                                    $set('end_date', \Carbon\Carbon::parse($get('start_date'))->addDays($plan->days)->toDateString());
                                }
                            }),

                        DatePicker::make('end_date')
                            ->label('End Date')
                            ->required()
                            ->disabled()
                            ->dehydrated(),

                        // Status is derived automatically from start/end dates in the
                        // create/edit page handlers, so there is no manual status input here.
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

                TextColumn::make('gym.assigned_id')
                    ->label('Facility ID')
                    ->formatStateUsing(fn ($state) => $state ? str_pad($state, 6, '0', STR_PAD_LEFT) : '—')
                    ->fontFamily('mono')
                    ->sortable()
                    ->toggleable(),

                TextColumn::make('gym.name')
                    ->label('Gym Facility')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),

                TextColumn::make('systemPlan.name')
                    ->label('Plan')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('start_date')
                    ->date()
                    ->sortable(),

                TextColumn::make('end_date')
                    ->date()
                    ->sortable()
                    ->color(function ($state) {
                        $date = \Carbon\Carbon::parse($state);
                        if ($date->isPast()) {
                            return 'danger';
                        }
                        if ($date->diffInDays(now()) <= 7) {
                            return 'warning';
                        }
                        return 'success';
                    }),

                // Status column kept for BC – auto-derived from end_date in observer
                // Will be removed in Problem 5D
                TextColumn::make('status')
                    ->badge()
                    ->color(fn (?string $state): string => match ($state) {
                        'ongoing' => 'success',
                        'expired' => 'danger',
                        'upcoming' => 'warning',
                        'cancelled' => 'gray',
                        default => 'gray',
                    })
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->visibleFrom('md'),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->options([
                        'ongoing' => 'Ongoing',
                        'expired' => 'Expired',
                        'upcoming' => 'Upcoming',
                        'cancelled' => 'Cancelled',
                    ]),

                SelectFilter::make('gym_id')
                    ->label('Gym')
                    ->options(fn () => Gym::pluck('name', 'id'))
                    ->searchable(),

                SelectFilter::make('system_plan_id')
                    ->label('Plan')
                    ->options(fn () => SystemPlan::pluck('name', 'id'))
                    ->searchable(),

                Filter::make('expiring_soon')
                    ->label('Expiring in 7 Days')
                    ->query(fn (Builder $query) => $query->where('end_date', '<=', now()->addDays(7)->toDateString())
                        ->where('end_date', '>=', now()->toDateString())),
            ])
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
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListGymSubscriptions::route('/'),
            'create' => Pages\CreateGymSubscription::route('/create'),
            'edit' => Pages\EditGymSubscription::route('/{record}/edit'),
        ];
    }
}
