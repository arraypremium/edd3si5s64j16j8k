<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * System Role – Site Admin roles
 *
 * STORAGE: system_roles table (COMPLETELY SEPARATE from Spatie roles)
 *
 * Site Admin roles (system_admins) are stored here:
 *   system_roles ←→ system_role_assignment ←→ system_admins
 *
 * Business / Facility roles (users) are stored in Spatie:
 *   roles ←→ model_has_roles ←→ users
 *
 * These two role systems NEVER touch each other.
 */
class SystemRole extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'system_roles';

    protected $fillable = [
        'name',
        'label',
        'description',
    ];

    /**
     * Admins assigned to this system role.
     */
    public function systemAdmins(): BelongsToMany
    {
        return $this->belongsToMany(
            SystemAdmin::class,
            'system_role_assignment',
            'system_role_id',
            'system_admin_id'
        )->withTimestamps();
    }
}
