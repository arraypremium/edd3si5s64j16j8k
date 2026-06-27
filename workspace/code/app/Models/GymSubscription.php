<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class GymSubscription extends Model
{
    use HasFactory;

    protected $fillable = [
        'gym_id',
        'system_plan_id',
        'start_date',
        'end_date',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'start_date' => 'date',
            'end_date' => 'date',
            'status' => 'string',
        ];
    }

    public static function deriveStatus(string $startDate, string $endDate): string
    {
        $today = now()->startOfDay();
        $start = Carbon::parse($startDate)->startOfDay();
        $end = Carbon::parse($endDate)->startOfDay();

        if ($end->lt($today)) {
            return 'expired';
        }

        if ($start->gt($today)) {
            return 'upcoming';
        }

        return 'ongoing';
    }

    public function gym(): BelongsTo
    {
        return $this->belongsTo(Gym::class);
    }

    public function systemPlan(): BelongsTo
    {
        return $this->belongsTo(SystemPlan::class, 'system_plan_id');
    }

    public function scopeActive($query)
    {
        return $query->where('status', 'ongoing');
    }

    public function scopeExpired($query)
    {
        return $query->where('status', 'expired')
            ->orWhere('end_date', '<', now()->toDateString());
    }

    public function scopeExpiringSoon($query, int $days = 7)
    {
        return $query->where('end_date', '<=', now()->addDays($days)->toDateString())
            ->where('end_date', '>=', now()->toDateString());
    }
}
