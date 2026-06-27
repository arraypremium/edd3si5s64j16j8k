<?php

namespace App\Services;

use App\Contracts\SequenceRepository;
use App\Contracts\SettingsRepository;
use App\Helpers\Helpers;
use App\Support\Data;
use Filament\Facades\Filament;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

/**
 * JSON-backed multi-tenant sequence generator.
 *
 * Reads prefix and last_number from SettingsRepository within isolated tenant buckets
 * (`gym_sequences.{gym_id}.{type}`) and inspects the tenant database records
 * to avoid collisions within the current fiscal span.
 */
class JsonSequenceRepository implements SequenceRepository
{
    public function __construct(
        protected SettingsRepository $settingsRepository,
    ) {}

    /**
     * Generate the next number for a given entity type under the active tenant.
     *
     * @param  class-string  $modelClass
     */
    public function generate(
        string $type,
        string $modelClass,
        ?string $dateString = null,
        ?string $modelColumn = 'number',
    ): string {
        $date = Helpers::parseDate($dateString);
        [$start, $end] = Helpers::getFiscalSpan($date);
        $settings = $this->settingsRepository->get();

        $gymId = class_exists(Filament::class) && Filament::getTenant() ? Filament::getTenant()->id : 'global';

        /** @var \Illuminate\Database\Eloquent\Model $model */
        $model = new $modelClass;
        $table = $model->getTable();

        $dateColumn = Schema::hasColumn($table, 'date')
            ? 'date'
            : 'created_at';

        // Retrieve from isolated tenant bucket first, fallback to standard entity defaults
        $rawPrefix = data_get($settings, "gym_sequences.{$gymId}.{$type}.prefix", data_get($settings, "{$type}.prefix", ''));
        $rawSaved = data_get($settings, "gym_sequences.{$gymId}.{$type}.last_number", data_get($settings, "{$type}.last_number", ''));

        $prefix = trim(Data::string($rawPrefix), '-');
        $prefix = filled($prefix) ? $prefix : 'GY';
        $separator = $prefix !== '' ? '-' : '';
        $match = $prefix.$separator;

        $query = $modelClass::query();
        if ($gymId !== 'global' && Schema::hasColumn($table, 'gym_id')) {
            $query->where('gym_id', $gymId);
        }

        $lastFromDb = $query
            ->whereBetween($dateColumn, [$start->toDateString(), $end->toDateString()])
            ->pluck($modelColumn ?? 'number')
            ->map(
                fn ($raw) => Str::of(Data::string($raw))
                    ->whenStartsWith($match, fn ($s) => $s->after($match))
                    ->__toString()
            )
            ->map(fn ($v) => is_numeric($v) ? (int) $v : 0)
            ->max() ?: 0;

        $lastFromSettings = Str::of(Data::string($rawSaved))
            ->whenStartsWith($match, fn ($s) => $s->after($match))
            ->__toString();
        $lastFromSettings = is_numeric($lastFromSettings)
            ? (int) $lastFromSettings
            : 0;

        $next = max($lastFromDb, $lastFromSettings) + 1;

        return str($prefix)
            ->when($separator !== '', fn ($s) => $s->append($separator))
            ->append((string) $next)
            ->__toString();
    }

    /**
     * Persist the last number for the active tenant facility.
     */
    public function update(
        string $type,
        string $newNumber,
        ?string $date = null,
    ): void {
        $date = Helpers::parseDate($date);
        [$start, $end] = Helpers::getFiscalSpan($date);

        if (! $date->between($start, $end)) {
            return;
        }

        $settings = $this->settingsRepository->get();
        $gymId = class_exists(Filament::class) && Filament::getTenant() ? Filament::getTenant()->id : 'global';

        $rawPrefix = data_get($settings, "gym_sequences.{$gymId}.{$type}.prefix", data_get($settings, "{$type}.prefix", 'GY'));
        $prefix = trim(Data::string($rawPrefix), '-');

        $numericPart = Str::of($newNumber)
            ->match('/(\\d+)$/')
            ->__toString();

        if ($numericPart === '' || ! ctype_digit($numericPart)) {
            return;
        }

        $incoming = (int) $numericPart;
        $rawStored = data_get($settings, "gym_sequences.{$gymId}.{$type}.last_number", data_get($settings, "{$type}.last_number", ''));
        $storedNumeric = Str::of(Data::string($rawStored))
            ->match('/(\\d+)$/')
            ->__toString();
        $current = ctype_digit($storedNumeric) ? (int) $storedNumeric : 0;

        if ($incoming <= $current) {
            return;
        }

        // Save exactly into the tenant's isolated settings sequence bucket
        $tenantTypeSettings = data_get($settings, "gym_sequences.{$gymId}.{$type}", []);
        if (! is_array($tenantTypeSettings)) {
            $tenantTypeSettings = [];
        }
        $tenantTypeSettings['last_number'] = $incoming;
        $tenantTypeSettings['prefix'] = $prefix;
        data_set($settings, "gym_sequences.{$gymId}.{$type}", $tenantTypeSettings);

        // Also update fallback global settings
        if (! isset($settings[$type]) || ! is_array($settings[$type])) {
            $settings[$type] = [];
        }
        /** @var array<string, mixed> $typeSettings */
        $typeSettings = $settings[$type];
        $typeSettings['last_number'] = max(data_get($typeSettings, 'last_number', 0), $incoming);
        $typeSettings['prefix'] = $prefix;
        $settings[$type] = $typeSettings;

        $this->settingsRepository->put($settings);
    }
}
