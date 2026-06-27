<?php

namespace App\Filament\Resources\Enquiries\Schemas;

use App\Helpers\Helpers;
use App\Models\Service;
use App\Models\User;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Blade;

class EnquiryForm
{
    /**
     * Configure the enquiry form schema.
     */
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(1)
            ->components([
                Section::make(__('app.ui.details'))
                    ->schema([
                        TextInput::make('name')
                            ->label(__('app.fields.name'))
                            ->required()
                            ->maxLength(255)
                            ->placeholder(__('app.placeholders.example_full_name')),
                        TextInput::make('email')
                            ->label(__('app.fields.email'))
                            ->email()
                            ->required()
                            ->live()
                            ->placeholder(__('app.placeholders.example_email'))
                            ->unique('enquiries', 'email', ignoreRecord: true),
                        TextInput::make('contact')
                            ->label(__('app.fields.contact'))
                            ->tel()
                            ->required()
                            ->placeholder(__('app.placeholders.example_phone')),
                        DatePicker::make('dob')
                            ->label(__('app.fields.dob')),
                        DatePicker::make('date')
                            ->label(__('app.fields.date'))
                            ->default(now()),
                        Radio::make('gender')
                            ->options([
                                'male' => __('app.options.gender.male'),
                                'female' => __('app.options.gender.female'),
                                'other' => __('app.options.gender.other'),
                            ])
                            ->label(__('app.fields.gender'))
                            ->default('male')
                            ->inline()
                            ->inlineLabel(false)
                            ->required(),
                        Select::make('user_id')
                            ->label(__('app.fields.lead_owner'))
                            ->placeholder(__('app.placeholders.select_lead_owner'))
                            ->relationship(
                                name: 'user',
                                titleAttribute: 'name',
                                modifyQueryUsing: fn ($query) => $query
                                    ->where(function ($query) {
                                        $query->whereNull('username')
                                            ->orWhereNotIn('username', ['admin', 'test']);
                                    })
                                    ->where(function ($query) {
                                        $query->whereNull('name')
                                            ->orWhereRaw('LOWER(name) != ?', ['user']);
                                    })
                                    ->orderBy('name')
                                    ->orderBy('username'),
                            )
                            ->required()
                            ->getOptionLabelFromRecordUsing(function (User $record): string {
                                $displayName = trim((string) ($record->name ?: $record->username ?: __('app.resources.users.singular')));

                                if (strtolower($displayName) === 'user' && filled($record->username)) {
                                    $displayName = (string) $record->username;
                                }

                                $name = html_entity_decode($displayName, ENT_QUOTES, 'UTF-8');
                                $avatarName = urlencode($name);
                                $url = ! empty($record->photo) ? e($record->photo) : "https://ui-avatars.com/api/?background=000&color=fff&name={$avatarName}";

                                return Blade::render(
                                    '<div class="flex items-center gap-2 h-9">
                                    <x-filament::avatar src="{{ $url }}" alt="{{ $name }}" size="sm" />
                                    <span class="ml-2">{{ $name }}</span>
                                 </div>',
                                    compact('url', 'name')
                                );
                            })
                            ->allowHtml(),
                        DatePicker::make('start_by')
                            ->label(__('app.fields.start_by'))
                            ->minDate(now())
                            ->placeholder(now()->format('d-m-Y')),
                    ])
                    ->columns([
                        'default' => 1,
                        'md' => 2,
                        'xl' => 3,
                    ])
                    ->columnSpanFull(),
                Section::make(__('app.ui.location'))
                    ->schema([
                        Textarea::make('address')
                            ->label(__('app.fields.address'))
                            ->placeholder(__('app.placeholders.address_example')),
                        Group::make()
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
                                    ->searchable()
                                    ->reactive(),
                                Select::make('city')
                                    ->label(__('app.fields.city'))
                                    ->placeholder(__('app.placeholders.select_city'))
                                    ->options(fn ($get) => Helpers::getCities($get('state')))
                                    ->searchable()
                                    ->reactive(),
                                TextInput::make('pincode')
                                    ->label(__('app.fields.pincode'))
                                    ->numeric()
                                    ->placeholder(__('app.placeholders.pincode')),
                            ])
                            ->columns([
                                'default' => 1,
                                'md' => 2,
                                'xl' => 4,
                            ]),
                    ]),
                Section::make(__('app.ui.preferences'))
                    ->schema([
                        Select::make('interested_in')
                            ->label(__('app.fields.interested_in'))
                            ->multiple()
                            ->placeholder(__('app.placeholders.select_services'))
                            ->options(fn () => Service::pluck('name', 'name')->toArray()),
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
                    ]),
                Section::make(__('app.ui.follow_details'))
                    ->schema([
                        Repeater::make('followUps')
                            ->relationship('followUps')
                            ->itemLabel('')
                            ->hiddenLabel()
                            ->columnSpanFull()
                            ->extraAttributes(['class' => 'new_enquiry_follow_up'])
                            ->schema([
                                Select::make('method')
                                    ->options([
                                        'call' => __('app.options.follow_up_method.call'),
                                        'email' => __('app.options.follow_up_method.email'),
                                        'in_person' => __('app.options.follow_up_method.in_person'),
                                        'whatsapp' => __('app.options.follow_up_method.whatsapp'),
                                        'other' => __('app.options.follow_up_method.other'),
                                    ])->default('call')
                                    ->label(__('app.fields.follow_up_method'))
                                    ->placeholder(__('app.placeholders.select_follow_up_method')),
                                DatePicker::make('schedule_date')
                                    ->label(__('app.fields.due_date')),
                            ])
                            ->columns([
                                'default' => 1,
                                'md' => 2,
                            ])
                            ->maxItems(1)
                            ->deletable(false),
                    ])
                    ->hiddenOn('edit'),
            ]);
    }
}
