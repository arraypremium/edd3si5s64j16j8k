<?php

namespace App\Models\Concerns;

use App\Exceptions\CrossTenantException;
use App\Models\Gym;
use Filament\Facades\Filament;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

trait BelongsToGym
{
    /**
     * Performant Static DB Cache: Bulk seeders ke dauran 1000 queries ko 1 me badal dega
     * Typing error fully fixed with Dollar sign ($)
     */
    protected static ?int $staticCachedCentralGymId = null;

    /**
     * Boot the BelongsToGym trait for a model.
     */
    protected static function bootBelongsToGym(): void
    {
        static::creating(function (Model $model) {
            if (empty($model->gym_id) && Schema::hasTable('gyms')) {
                if (class_exists(Filament::class) && Filament::getTenant() instanceof Gym) {
                    $model->gym_id = Filament::getTenant()->id;
                } else {
                    // Ultra-fast DB lookup caching
                    if (self::$staticCachedCentralGymId === null) {
                        self::$staticCachedCentralGymId = Gym::where('name', 'Central Gym')->value('id') ?? Gym::value('id') ?? 1;
                    }

                    if (self::$staticCachedCentralGymId) {
                        $model->gym_id = self::$staticCachedCentralGymId;
                    } else {
                        throw new CrossTenantException(
                            "Tenancy Exception: Cannot create target record without valid gym_id."
                        );
                    }
                }
            }
        });

        static::addGlobalScope('gym_tenant', function (Builder $builder) {
            if (Schema::hasTable('gyms')) {
                $gymId = null;

                // 1. Resolve gym ID from Filament tenant context if available
                if (class_exists(Filament::class) && ($tenant = Filament::getTenant()) instanceof Gym) {
                    $gymId = $tenant->id;
                } 
                // 2. Fallback: Resolve gym ID from secure session or user pivot mapping during background AJAX updates
                elseif (auth()->check()) {
                    $user = auth()->user();
                    if ($user && method_exists($user, 'isSuperAdmin') && ! $user->isSuperAdmin()) {
                        $gymId = session('active_gym_id') ?? DB::table('gym_user')->where('user_id', $user->id)->value('gym_id');
                    }
                }

                if ($gymId) {
                    $builder->where($builder->getModel()->getTable() . '.gym_id', $gymId);
                }
            }
        });
    }

    /**
     * Get the gym that owns the model.
     */
    public function gym(): BelongsTo
    {
        return $this->belongsTo(Gym::class, 'gym_id');
    }
}