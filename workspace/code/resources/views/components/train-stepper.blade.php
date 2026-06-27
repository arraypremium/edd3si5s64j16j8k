@props(['steps' => []])

<div {{ $attributes->merge(['class' => 'fi-train-stepper flex items-center gap-3 overflow-x-auto p-4 bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 shadow-sm mb-6']) }}>
    @foreach($steps as $index => $step)
        <div class="fi-train-step flex items-center gap-3 flex-shrink-0">
            <div @class([
                'fi-train-step-circle flex items-center justify-center w-10 h-10 rounded-full font-bold text-sm transition-colors',
                'bg-primary-500 text-white' => $step['completed'] ?? false,
                'bg-gray-200 text-gray-700 dark:bg-gray-700 dark:text-gray-300' => !($step['completed'] ?? false),
            ])>
                @if($step['completed'] ?? false)
                    <x-heroicon-s-check class="w-5 h-5" />
                @else
                    {{ $index + 1 }}
                @endif
            </div>
            <div class="fi-train-step-label">
                <a href="{{ $step['url'] }}" class="font-semibold text-sm hover:underline {{ ($step['completed'] ?? false) ? 'text-primary-600 dark:text-primary-400' : 'text-gray-700 dark:text-gray-300' }}">
                    {{ $step['label'] }}
                </a>
                @if(filled($step['description'] ?? null))
                    <p class="text-xs text-gray-500 dark:text-gray-400">{{ $step['description'] }}</p>
                @endif
            </div>
            @if(!$loop->last)
                <div @class([
                    'fi-train-connector w-12 h-0.5',
                    'bg-primary-300' => ($step['completed'] ?? false) && ($steps[$index + 1]['completed'] ?? false),
                    'bg-gray-300 dark:bg-gray-600' => !($step['completed'] ?? false) || !($steps[$index + 1]['completed'] ?? false),
                ])></div>
            @endif
        </div>
    @endforeach
</div>
