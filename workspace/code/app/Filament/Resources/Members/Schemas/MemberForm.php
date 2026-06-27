<?php

namespace App\Filament\Resources\Members\Schemas;

use App\Filament\Resources\Subscriptions\Schemas\SubscriptionForm;
use App\Helpers\Helpers;
use Filament\Facades\Filament;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Contracts\HasSchemas;
use Filament\Schemas\Schema;
use Illuminate\Validation\Rules\Unique;
use Livewire\Component;

class MemberForm
{
    /**
     * Configure the member form schema.
     */
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(1)
            ->components([
                Section::make()
                    ->schema([
                        FileUpload::make('photo')
                            ->imageEditor()
                            ->preserveFilenames()
                            ->maxSize(1024 * 1024 * 10)
                            ->disk('public')
                            ->directory(fn () => class_exists(Filament::class) && Filament::getTenant() 
                                ? 'images/' . Filament::getTenant()->id 
                                : 'images'
                            )
                            ->image()
                            ->placeholder(__('app.placeholders.upload_logo'))
                            ->loadingIndicatorPosition('left')
                            ->panelAspectRatio('6:7')
                            ->panelLayout('integrated')
                            ->removeUploadedFileButtonPosition('right')
                            ->uploadButtonPosition('left')
                            ->uploadProgressIndicatorPosition('left'),

                        Grid::make()
                            ->schema([
                                TextInput::make('code')
                                    ->placeholder(__('app.placeholders.member_code'))
                                    ->label(__('app.fields.member_code'))
                                    ->readOnly()
                                    ->disabled()
                                    ->dehydrated(false),
                                TextInput::make('name')
                                    ->label(__('app.fields.name'))
                                    ->required()
                                    ->maxLength(255)
                                    ->placeholder(__('app.placeholders.example_full_name'))
                                    ->columnSpan([
                                        'default' => 1,
                                        'xl' => 2,
                                    ]),
                                TextInput::make('email')
                                    ->label(__('app.fields.email'))
                                    ->email()
                                    ->live()
                                    ->maxLength(255)
                                    ->required()
                                    ->placeholder(__('app.placeholders.example_email'))
                                    ->unique(
                                        table: 'members',
                                        column: 'email',
                                        ignoreRecord: true,
                                        modifyRuleUsing: function (Unique $rule) {
                                            if (class_exists(Filament::class) && Filament::getTenant()) {
                                                return $rule->where('gym_id', Filament::getTenant()->id);
                                            }
                                            return $rule;
                                        }
                                    ),
                                TextInput::make('contact')
                                    ->label(__('app.fields.contact'))
                                    ->tel()
                                    ->placeholder(__('app.placeholders.example_phone'))
                                    ->maxLength(20)
                                    ->regex('/^\+?[0-9\s\-\(\)]+$/') // Allows +, digits, spaces, dashes, and parentheses
                                    ->required()
                                    ->hintIcon('heroicon-m-question-mark-circle')
                                    ->hintIconTooltip(__('app.help.phone_format')),
                                TextInput::make('emergency_contact')
                                    ->label(__('app.fields.emergency_contact'))
                                    ->tel()
                                    ->placeholder(__('app.placeholders.example_phone'))
                                    ->maxLength(20)
                                    ->regex('/^\+?[0-9\s\-\(\)]+$/') // Allows +, digits, spaces, dashes, and parentheses
                                    ->hintIcon('heroicon-m-question-mark-circle')
                                    ->hintIconTooltip(__('app.help.phone_format')),
                                Select::make('gender')
                                    ->options([
                                        'male' => __('app.options.gender.male'),
                                        'female' => __('app.options.gender.female'),
                                        'other' => __('app.options.gender.other'),
                                    ])->default('male')
                                    ->label(__('app.fields.gender'))
                                    ->selectablePlaceholder(false)
                                    ->required(),
                                DatePicker::make('dob')
                                    ->label(__('app.fields.dob'))
                                    ->placeholder(__('app.placeholders.date_example')),
                                TextInput::make('health_issue')
                                    ->label(__('app.fields.health_issues'))
                                    ->maxLength(500)
                                    ->placeholder(__('app.placeholders.health_issues')),
                                Select::make('source')
                                    ->options([
                                        'word_of_mouth' => __('app.options.source.word_of_mouth'),
                                        'google_business_account' => __('app.options.source.google_business_account'),
                                        'website' => __('app.options.source.website'),
                                        'instagram' => __('app.options.source.instagram'),
                                        'facebook' => __('app.options.source.facebook'),
                                        'whatsapp' => __('app.options.source.whatsapp'),
                                        'justdial' => __('app.options.source.justdial'),
                                        'referral' => __('app.options.source.referral'),
                                        'other' => __('app.options.source.other'),
                                    ])->default('word_of_mouth')
                                    ->label(__('app.fields.source'))
                                    ->selectablePlaceholder(false),
                            ])
                            ->columns([
                                'default' => 1,
                                'md' => 2,
                                'xl' => 3,
                            ])
                            ->columnSpan([
                                'default' => 1,
                                'lg' => 3,
                            ]),
                    ])->columns([
                        'default' => 1,
                        'lg' => 4,
                    ]),
                Section::make(__('app.ui.location'))
                    ->columns([
                        'default' => 1,
                        'md' => 2,
                    ])
                    ->schema([
                        Textarea::make('address')
                            ->label(__('app.fields.address'))
                            ->rows(5)
                            ->placeholder(__('app.placeholders.address_example')),
                        Group::make()
                            ->columns([
                                'default' => 1,
                                'md' => 2,
                            ])
                            ->schema([
                                Select::make('country')
                                    ->label(__('app.fields.country'))
                                    ->placeholder(__('app.placeholders.select_country'))
                                    ->options(Helpers::getCountries())
                                    ->reactive()
                                    ->afterStateUpdated(fn ($state, callable $set) => [
                                        $set('state', null),
                                        $set('city', null),
                                    ]),
                                Select::make('state')
                                    ->label(__('app.fields.state'))
                                    ->placeholder(__('app.placeholders.select_state'))
                                    ->options(fn ($get) => Helpers::getStates($get('country')))
                                    ->reactive(),
                                Select::make('city')
                                    ->label(__('app.fields.city'))
                                    ->placeholder(__('app.placeholders.select_city'))
                                    ->options(fn ($get) => Helpers::getCities($get('state')))
                                    ->reactive(),
                                TextInput::make('pincode')
                                    ->label(__('app.fields.pincode'))
                                    ->numeric()
                                    ->placeholder(__('app.placeholders.pincode')),
                            ]),
                    ]),
                Section::make(__('app.titles.subscription_and_invoice'))
                    ->visibleOn('create')
                    ->schema([
                        Repeater::make('subscriptions')
                            ->relationship('subscriptions')
                            ->itemLabel('')
                            ->hiddenLabel()
                            ->columnSpanFull()
                            ->maxItems(1)
                            ->deletable(false)
                            ->extraAttributes(['class' => 'rmv_rept-space'])
                            ->columns([
                                'default' => 1,
                                'xl' => 3,
                            ])
                            ->schema(fn (HasSchemas&Component $livewire): array => SubscriptionForm::configure(Schema::make($livewire))
                                ->getComponents(withActions: false)),
                    ]),
            ]);
    }
}
