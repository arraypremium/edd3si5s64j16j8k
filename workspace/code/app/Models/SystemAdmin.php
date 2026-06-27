<?php

namespace App\Models;

use App\Enums\Status;
use Filament\Models\Contracts\FilamentUser;
use Filament\Models\Contracts\HasAvatar;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * SystemAdmin – Site Admin
 *
 * AUTH TABLE: system_admins
 * ROLE TABLE: system_roles  ← SEPARATE, never touches Spatie roles table
 * PIVOT:      system_role_assignment
 * PANEL:      /system only
 *
 * Business Admin (facility users) use:
 *   users ←→ model_has_roles ←→ roles (Spatie)
 *   COMPLETELY DIFFERENT TABLE.
 */
class SystemAdmin extends Authenticatable implements FilamentUser, HasAvatar
{
    use HasFactory, Notifiable, SoftDeletes;

    protected $table = 'system_admins';

    protected $fillable = [
        'name',
        'username',
        'password',
        'status',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
            'status' => Status::class,
        ];
    }

    /**
     * Site Admin roles – uses system_roles table ONLY.
     * NEVER touches Spatie roles table.
     */
    public function systemRoles(): BelongsToMany
    {
        return $this->belongsToMany(
            SystemRole::class,
            'system_role_assignment',
            'system_admin_id',
            'system_role_id'
        )->withTimestamps();
    }

    /**
     * Check if admin has a specific site role.
     */
    public function hasSystemRole(string $name): bool
    {
        return $this->systemRoles()->where('system_roles.name', $name)->exists();
    }

    /**
     * Super admin check – Gate::before bypass.
     * TODO: replace hard true with real system_role check:
     * return $this->hasSystemRole('super_admin');
     */
    public function isSuperAdmin(): bool
    {
        return true;
    }

    /** Dummy Spatie-shield compatibility – prevents BadMethodCallException */
    public function hasRole($roles, $guard = null): bool { return true; }
    public function hasPermissionTo($permission, $guardName = null): bool { return true; }
    public function hasAnyRole(...$roles): bool { return true; }
    public function hasAllRoles(...$roles): bool { return true; }
    public function hasAnyPermission(...$permissions): bool { return true; }

    public function canAccessPanel(Panel $panel): bool
    {
        // Site Admins can ONLY access the 'system' panel
        // Business Admins (users table) can ONLY access 'admin' panel
        return $panel->getId() === 'system';
    }

    public function getFilamentAvatarUrl(): ?string
    {
        return 'https://ui-avatars.com/api/?background=000&color=fff&name=' . urlencode($this->name);
    }
}
