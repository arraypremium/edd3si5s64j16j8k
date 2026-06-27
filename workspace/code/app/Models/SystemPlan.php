<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SystemPlan extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'code',
        'description',
        'days',
        'amount',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'status' => \App\Enums\Status::class,
            'amount' => 'decimal:2',
            'days' => 'integer',
        ];
    }

    public function gymSubscriptions(): HasMany
    {
        return $this->hasMany(GymSubscription::class, 'system_plan_id');
    }

    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function scopeByCode($query, string $code)
    {
        return $query->where('code', $code);
    }
}
