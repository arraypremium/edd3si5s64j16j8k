<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GymResource\Pages;
use App\Filament\Resources\GymResource\RelationManagers\UsersRelationManager;
use App\Models\Gym;
use App\Models\SystemPlan;
use App\Models\User;
use App\Rules\ReservedBusinessSlug;
use App\Support\Roles\BusinessRoleManager;
use Filament\Actions\Action;
use Filament\Actions\ActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Collection;

class GymResource extends Resource
{
    protected static ?string $model = Gym::class;
    protected static ?string $recordTitleAttribute = 'name';
    protected static bool $isGloballySearchable = true;
    protected static ?string $navigationLabel = 'Businesses';
    protected static ?string $modelLabel = 'Business';
    protected static ?string $pluralModelLabel = 'Businesses';
    protected static ?int $navigationSort = 1;
    protected static bool $isScopedToTenant = false;

    public static function getNavigationIcon(): ?string { return null; }
    public static function getGloballySearchableAttributes(): array { return ['name','assigned_id','url_slug']; }
    public static function getGlobalSearchResultDetails(\Illuminate\Database\Eloquent\Model $record): array {
        return ['Facility ID' => str_pad($record->assigned_id, 6, '0', STR_PAD_LEFT), 'URL Slug' => $record->url_slug, 'Status' => ucfirst($record->status)];
    }
    public static function shouldRegisterNavigation(): bool { return filament()->getCurrentPanel()?->getId() === 'system'; }
    public static function canAccess(): bool {
        $user = auth()->user();
        return filament()->getCurrentPanel()?->getId() === 'system' && $user && method_exists($user, 'isSuperAdmin') && $user->isSuperAdmin();
    }

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->columns(1)
            ->components([
                Section::make('General Information')
                    ->description('Master facility identity and operational status.')
                    ->columnSpanFull()
                    ->schema([
                        TextInput::make('assigned_id')->label('Facility ID')->placeholder('e.g. 000001')->required()->maxLength(6)
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn (callable $set, $state) => filled($state) ? $set('assigned_id', str_pad(preg_replace('/[^0-9a-zA-Z]/', '', $state), 6, '0', STR_PAD_LEFT)) : null)
                            ->dehydrateStateUsing(fn ($state) => str_pad(preg_replace('/[^0-9a-zA-Z]/', '', $state ?? ''), 6, '0', STR_PAD_LEFT))
                            ->unique(Gym::class, 'assigned_id', ignoreRecord: true),
                        TextInput::make('name')->required()->maxLength(255)->placeholder('Gym Name'),
                        Select::make('status')->options(['active' => 'Active (Fully Operational)','suspended' => 'Suspended (Access Intercepted & Locked)','inactive' => 'Inactive'])->default('active')->required(),
                        TextInput::make('url_slug')
                            ->label('URL Slug')
                            ->placeholder('e.g. business-one')
                            ->helperText(fn (?Gym $record): string => $record?->url_slug
                                ? 'Locked business login URL: /'.$record->url_slug.'/login'
                                : 'Manual business login slug. Business owners must login at /[slug]/login.')
                            ->required()
                            ->maxLength(80)
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn (callable $set, $state) => filled($state) ? $set('url_slug', ReservedBusinessSlug::normalize($state)) : null)
                            ->dehydrateStateUsing(fn ($state) => ReservedBusinessSlug::normalize($state))
                            ->rules([new ReservedBusinessSlug])
                            ->unique(Gym::class, 'url_slug', ignoreRecord: true)
                            ->readOnly(fn (?Gym $record): bool => filled($record?->url_slug))
                            ->disabled(fn (?Gym $record): bool => filled($record?->url_slug))
                            ->dehydrated(fn (?Gym $record): bool => ! filled($record?->url_slug)),

                    ])->columns(1),

                Section::make('Assigned Facility Staff & Owners')
                    ->visibleOn('create')->columnSpanFull()
                    ->description('Create and assign the initial Business Admin user.')
                    ->schema([
                        TextInput::make('user_name')->label('User Name')->placeholder('e.g. Master Owner')->required(fn ($livewire) => $livewire instanceof Pages\CreateGym)->maxLength(255),
                        TextInput::make('user_username')->label('Login Username')->placeholder('e.g. admin_owner')->required(fn ($livewire) => $livewire instanceof Pages\CreateGym)->maxLength(255)->unique(User::class, 'username'),
                        TextInput::make('user_password')->label('User Password')->placeholder('Enter password...')->password()->required(fn ($livewire) => $livewire instanceof Pages\CreateGym)->revealable()->maxLength(255),
                        Select::make('user_role')
                            ->label('Role')
                            ->hint('Create roles first in /system/shield/roles, then assign one here.')
                            ->options(fn (): array => BusinessRoleManager::options())
                            ->searchable()->preload()->native(false)
                            ->required(fn ($livewire) => $livewire instanceof Pages\CreateGym)
                            ->live(),
                    ])->columns(1),

                Section::make('Owner Details')
                    ->description('Master contact credentials for the facility owner.')
                    ->columnSpanFull()
                    ->schema([
                        TextInput::make('owner_name')->label('Owner Name')->placeholder('Owner Full Name')->required()->maxLength(255),
                        TextInput::make('owner_number')->label('Owner Number')->placeholder('Owner Phone Number')->tel()->required()->maxLength(255),
                        TextInput::make('owner_email')->label('Owner Email')->placeholder('owner@example.com')->email()->required()->maxLength(255),
                    ])->columns(1),

                Section::make('Business Details')
                    ->description('Registered business information and location.')
                    ->columnSpanFull()
                    ->schema([
                        TextInput::make('business_name')->label('Business Name')->placeholder('e.g. FitZone Gym Pvt Ltd')->required()->maxLength(255),
                        TextInput::make('business_number')->label('Business Number')->placeholder('Business contact / GST phone')->tel()->required()->maxLength(50),
                        Textarea::make('business_address')->label('Business Address')->placeholder('Full registered business address...')->rows(3)->required()->columnSpanFull(),
                        TextInput::make('business_map_link')->label('Google Map Link')->placeholder('https://maps.google.com/?q=...')->url()->prefixIcon('heroicon-m-map-pin')->required()->maxLength(512)->columnSpanFull(),
                    ])->columns(1),

                Section::make('Subscription')
                    ->description('Assign a system plan to this business. Gym facility is auto-linked by ID after creation.')
                    ->columnSpanFull()
                    ->visibleOn('create')
                    ->schema([
                        Select::make('subscription_system_plan_id')
                            ->label('System Plan')
                            ->options(fn () => SystemPlan::where('status', 'active')->orderBy('name')->pluck('name', 'id'))
                            ->searchable()
                            ->preload()
                            ->required(fn ($livewire) => $livewire instanceof Pages\CreateGym)
                            ->live()
                            ->afterStateUpdated(function (callable $set, $state) {
                                $plan = SystemPlan::find($state);
                                if ($plan) {
                                    $set('subscription_start_date', now()->toDateString());
                                    $set('subscription_end_date', now()->addDays((int) $plan->days)->toDateString());
                                }
                            }),

                        DatePicker::make('subscription_start_date')
                            ->label('Start Date')
                            ->required(fn ($livewire) => $livewire instanceof Pages\CreateGym)
                            ->default(now())
                            ->live()
                            ->afterStateUpdated(function (callable $set, callable $get) {
                                $plan = SystemPlan::find($get('subscription_system_plan_id'));
                                if ($plan && $get('subscription_start_date')) {
                                    $set('subscription_end_date', \Carbon\Carbon::parse($get('subscription_start_date'))->addDays((int) $plan->days)->toDateString());
                                }
                            }),

                        DatePicker::make('subscription_end_date')
                            ->label('End Date')
                            ->required(fn ($livewire) => $livewire instanceof Pages\CreateGym)
                            ->disabled()
                            ->dehydrated(),
                    ])
                    ->columns(1),

                Section::make('System Information')
                    ->description('Internal administrative notes.')
                    ->columnSpanFull()
                    ->schema([
                        Textarea::make('description')
                            ->label('Description (System Admin Eyes Only)')
                            ->rows(3)
                            ->columnSpanFull(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('assigned_id')->label('Facility ID')->searchable()->sortable()->fontFamily('mono')->weight('bold')->color('primary')->formatStateUsing(fn ($state) => str_pad($state, 6, '0', STR_PAD_LEFT)),
                TextColumn::make('name')->searchable()->sortable()->weight('bold'),
                TextColumn::make('url_slug')->label('URL Slug')->searchable()->sortable()->fontFamily('mono')->copyable()->formatStateUsing(fn ($state) => $state ? '/'.$state.'/login' : 'Not set'),
                TextColumn::make('status')->badge()->color(fn (string $state): string => match ($state) {'active'=>'success','suspended'=>'danger','inactive'=>'warning',default=>'gray'}),
                TextColumn::make('systemPlan.name')->label('Current Plan')->searchable()->sortable()->toggleable()->placeholder('No Plan'),
                TextColumn::make('expiry_date')->label('Expiry Date')->date()->sortable(),
                TextColumn::make('subscription_status')->label('Subscription Status')->badge(),
                TextColumn::make('created_at')->dateTime()->sortable()->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([])
            ->recordActions([ActionGroup::make([ViewAction::make(), EditAction::make(), DeleteAction::make()])->label('Actions')->icon('heroicon-m-ellipsis-vertical')->color('gray')->button()])
            ->toolbarActions([\Filament\Actions\BulkActionGroup::make([DeleteBulkAction::make()])]);
    }

    public static function getRelations(): array { return [UsersRelationManager::class]; }
    public static function getPages(): array {
        return ['index' => Pages\ListGyms::route('/'), 'create' => Pages\CreateGym::route('/create'), 'edit' => Pages\EditGym::route('/{record}/edit')];
    }
}
