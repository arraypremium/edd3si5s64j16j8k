<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Gym extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'address',
        'assigned_id',
        'url_slug',
        'status',
        'expiry_date',
        'system_plan_id',
        'subscription_status',
        'owner_name',
        'owner_number',
        'owner_email',
        'map_link',
        'description',
        // Problem 4 – Business Details
        'business_name',
        'business_number',
        'business_address',
        'business_map_link',
    ];

    protected function casts(): array
    {
        return [
            'expiry_date' => 'date',
            'subscription_status' => 'string',
        ];
    }

    protected static function booted(): void
    {
        static::updating(function (self $gym): void {
            if (filled($gym->getOriginal('url_slug')) && $gym->isDirty('url_slug')) {
                $gym->url_slug = $gym->getOriginal('url_slug');
            }
        });
    }

    /**
     * Helper to check if the gym is currently active.
     */
    public function isActive(): bool
    {
        return $this->status === 'active';
    }

    /**
     * Helper to check if the gym is currently suspended.
     */
    public function isSuspended(): bool
    {
        return $this->status === 'suspended';
    }

    /**
     * Get the members belonging to the gym.
     */
    public function members(): HasMany
    {
        return $this->hasMany(Member::class);
    }

    /**
     * Get the users assigned to the gym.
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'gym_user')->withPivot('role')->withTimestamps();
    }

    /**
     * Get facility staff attached to this gym, EXCLUDING any system admin
     * (by username OR email collision) or user holding the Spatie 'super_admin' role.
     *
     * Defense in depth:
     *  - Pivot role != 'admin'
     *  - User username != 'admin'
     *  - No Spatie 'super_admin' role
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function facilityStaff(): BelongsToMany
    {
        return $this->users()
            ->wherePivot('role', '!=', 'admin')
            ->where(function ($q) {
                $q->whereNull('users.username')
                  ->orWhere('users.username', '!=', 'admin');
            })
            ->whereDoesntHave('roles', function ($q) {
                $q->where('name', 'super_admin');
            });
    }

    /**
     * Get the invoices for the gym.
     */
    public function invoices(): HasMany
    {
        return $this->hasMany(Invoice::class);
    }

    /**
     * Get the subscriptions for the gym.
     */
    public function subscriptions(): HasMany
    {
        return $this->hasMany(Subscription::class);
    }

    /**
     * Get the enquiries for the gym.
     */
    public function enquiries(): HasMany
    {
        return $this->hasMany(Enquiry::class);
    }

    /**
     * Get the plans created for the gym.
     */
    public function plans(): HasMany
    {
        return $this->hasMany(Plan::class);
    }

    /**
     * Get the services created for the gym.
     */
    public function services(): HasMany
    {
        return $this->hasMany(Service::class);
    }

    /**
     * Get the expenses for the gym.
     */
    public function expenses(): HasMany
    {
        return $this->hasMany(Expense::class);
    }

    /**
     * Get the system-level subscriptions for the gym (gym owner subscriptions).
     */
    public function gymSubscriptions(): HasMany
    {
        return $this->hasMany(GymSubscription::class, 'gym_id');
    }

    /**
     * Get the current system plan assigned to the gym.
     */
    public function systemPlan(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(SystemPlan::class, 'system_plan_id');
    }

    /**
     * Get the latest active gym subscription.
     */
    public function latestSubscription(): ?GymSubscription
    {
        return $this->gymSubscriptions()
            ->whereIn('status', ['ongoing', 'upcoming'])
            ->orderBy('start_date', 'desc')
            ->first();
    }

    /**
     * Check if the gym subscription has expired.
     */
    public function isExpired(): bool
    {
        if ($this->expiry_date === null) {
            return false;
        }

        return $this->expiry_date->isPast();
    }

    /**
     * Get the subscription expiry date.
     */
    public function getExpiryDate(): ?\Carbon\Carbon
    {
        return $this->expiry_date;
    }

    /**
     * Get the current plan name.
     */
    public function getPlanName(): ?string
    {
        return $this->systemPlan?->name;
    }

    /**
     * Sync gym subscription status from the latest subscription.
     */
    public function syncSubscriptionStatus(): void
    {
        $latest = $this->latestSubscription();

        if ($latest) {
            $this->expiry_date = $latest->end_date;
            $this->system_plan_id = $latest->system_plan_id;
            $this->subscription_status = $latest->end_date->isPast() ? 'expired' : 'active';
        } else {
            $this->expiry_date = null;
            $this->system_plan_id = null;
            $this->subscription_status = 'none';
        }

        $this->save();
    }

    /**
     * Scope to query expired gyms.
     */
    public function scopeExpired($query)
    {
        return $query->where('expiry_date', '<', now()->toDateString())
            ->whereNotNull('expiry_date');
    }

    /**
     * Scope to query gyms with expiring subscriptions.
     */
    public function scopeExpiringSoon($query, int $days = 7)
    {
        return $query->where('expiry_date', '<=', now()->addDays($days)->toDateString())
            ->where('expiry_date', '>=', now()->toDateString());
    }
}
