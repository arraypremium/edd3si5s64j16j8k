@php
/** @var string $heading */
/** @var string $totalExpense */
/** @var \Illuminate\Support\Collection<int, array{label: string, total: float, color: string, flex: float}> $segments */
/** @var bool $isLocked */
/** @var string|null $lockedMessage */

$filters = $this->getFilters();
@endphp

<x-filament-widgets::widget>
    <x-filament::section :heading="$heading" class="fi-wi-chart h-full">
        <x-slot name="afterHeader">
            @if ($filters && ! $isLocked)
            <x-filament::input.wrapper inline-prefix wire:target="filter" class="fi-wi-chart-filter">
                <x-filament::input.select inline-prefix wire:model.live="filter">
                    @foreach ($filters as $value => $label)
                    <option value="{{ $value }}">
                        {{ $label }}
                    </option>
                    @endforeach
                </x-filament::input.select>
            </x-filament::input.wrapper>
            @endif
        </x-slot>

        <div class="grid gap-4">
            <div class="text-3xl font-semibold tracking-tight text-gray-950 dark:text-white flex items-center gap-2">
                {{ $totalExpense }}
                @if ($isLocked)
                <x-filament::icon icon="heroicon-m-lock-closed" class="h-6 w-6 text-warning-500" />
                @endif
            </div>

            @if ($isLocked)
            <div class="rounded-xl border border-warning-200 bg-warning-50 px-4 py-3 text-sm font-medium text-warning-800 dark:border-warning-500/30 dark:bg-warning-500/10 dark:text-warning-200">
                {{ $lockedMessage }}
            </div>
            @endif

            <div class="grid gap-8">
                <div class="h-8 w-full overflow-hidden rounded-md bg-gray-100 shadow-sm ring-1 ring-gray-950/5 dark:bg-gray-800 dark:ring-white/10">
                    @if ($segments->isEmpty())
                    <div class="flex h-full items-center justify-center text-sm text-gray-500 dark:text-gray-400 gap-1.5">
                        @if ($isLocked)
                        <span>0</span>
                        <x-filament::icon icon="heroicon-m-lock-closed" class="h-4 w-4 text-warning-500 inline-block" />
                        @else
                        {{ __('app.widgets.no_expenses_in_period') }}
                        @endif
                    </div>
                    @else
                    <div class="flex h-full w-full gap-[1px]">
                        @foreach ($segments as $segment)
                        <div
                            class="h-full"
                            style="flex: {{ $segment['flex'] }}; background-color: {{ $segment['color'] }};"
                            title="{{ $segment['label'] }}"></div>
                        @endforeach
                    </div>
                    @endif
                </div>

                @if ($segments->isNotEmpty())
                <div x-data="{ expanded: false }">
                    <div :class="expanded ? '' : 'max-h-[3.75rem] overflow-hidden relative'">
                        <div class="grid grid-cols-1 gap-x-6 gap-y-3 sm:grid-cols-2">
                            @foreach ($segments as $segment)
                            <div class="flex items-start gap-2.5">
                                <span
                                    class="mt-1 h-3 w-3 shrink-0 rounded-full"
                                    style="background-color: {{ $segment['color'] }};"></span>

                                <div class="grid gap-0.5">
                                    <div class="text-xs font-medium text-gray-600 dark:text-gray-300">
                                        {{ $segment['label'] }}
                                    </div>
                                    <div class="text-sm font-semibold text-gray-950 dark:text-white">
                                        {{ \App\Helpers\Helpers::formatCurrency($segment['total']) }}
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @if ($segments->count() > 4)
                    <button type="button" @click="expanded = !expanded" class="mt-3 inline-flex items-center gap-1 text-xs font-bold text-primary-600 dark:text-primary-400 hover:underline">
                        <span x-text="expanded ? '- Show Less' : '+ Show More Categories'"></span>
                    </button>
                    @endif
                </div>
                @endif
            </div>
        </div>
    </x-filament::section>
</x-filament-widgets::widget>
