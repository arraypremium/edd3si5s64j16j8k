<?php

namespace App\Filament\Resources\Plans\Schemas;

use App\Enums\Status;
use App\Helpers\Helpers;
use Filament\Facades\Filament;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Fieldset;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\HtmlString;
use Illuminate\Validation\Rules\Unique;

class PlanForm
{
    /**
     * Configure the plan form schema.
     */
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(1)
            ->components([
                Fieldset::make()
                    ->label(function (Get $get): HtmlString {
                        $rawStatus = $get('status');
                        $status = Status::tryFrom(\App\Support\Data::string($rawStatus, Status::Active->value)) ?? Status::Active;
                        $html = Blade::render(
                            '<x-filament::badge class="inline-flex ml-2" :color="$color">
                                {{ $label }}
                            </x-filament::badge>',
                            [
                                'color' => $status->getColor(),
                                'label' => $status->getLabel(),
                            ]
                        );

                        return new HtmlString($html);
                    })
                    ->schema([
                        TextInput::make('name')
                            ->label(__('app.fields.name'))
                            ->placeholder(__('app.placeholders.plan_name'))
                            ->unique(
                                ignoreRecord: true,
                                modifyRuleUsing: function (Unique $rule) {
                                    if (class_exists(Filament::class) && Filament::getTenant()) {
                                        return $rule->where('gym_id', Filament::getTenant()->id);
                                    }
                                    return $rule;
                                }
                            )
                            ->required()
                            ->columnSpanFull(),
                        TextInput::make('code')
                            ->placeholder(__('app.placeholders.plan_code'))
                            ->label(__('app.fields.code'))
                            ->unique(
                                ignoreRecord: true,
                                modifyRuleUsing: function (Unique $rule) {
                                    if (class_exists(Filament::class) && Filament::getTenant()) {
                                        return $rule->where('gym_id', Filament::getTenant()->id);
                                    }
                                    return $rule;
                                }
                            )
                            ->required(),
                        Select::make('service_id')
                            ->label(__('app.fields.service'))
                            ->relationship(name: 'service', titleAttribute: 'name')
                            ->placeholder(__('app.placeholders.select_service'))
                            ->required()
                            ->columnSpan(2),
                        TextInput::make('days')
                            ->required()
                            ->placeholder(__('app.placeholders.plan_days'))
                            ->numeric()
                            ->label(__('app.fields.days'))
                            ->columnSpan(1),
                        TextInput::make('amount')
                            ->placeholder(__('app.placeholders.plan_amount'))
                            ->numeric()
                            ->prefix(Helpers::getCurrencySymbol())
                            ->label(__('app.fields.amount'))
                            ->required()
                            ->columnSpan(2),
                        TextInput::make('description')
                            ->placeholder(__('app.placeholders.plan_description'))
                            ->label(__('app.fields.description'))
                            ->columnSpanFull(),
                    ])->columns(3),
            ]);
    }
}
