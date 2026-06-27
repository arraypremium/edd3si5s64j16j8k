<?php

namespace App\Support\Roles;

use App\Models\Gym;
use App\Models\User;
use Illuminate\Support\Str;
use InvalidArgumentException;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

final class BusinessRoleManager
{
    /**
     * @return array<string, string>
     */
    public static function options(): array
    {
        return Role::query()
            ->where('guard_name', 'web')
            ->whereNull('roles.gym_id')
            ->orderBy('name')
            ->pluck('name', 'name')
            ->mapWithKeys(fn (string $name): array => [$name => Str::headline($name)])
            ->all();
    }

    public static function assignUserToGymRole(User $user, Gym $gym, string $roleName): void
    {
        $role = self::resolveRole($roleName);

        self::setPermissionsTeamId($gym->id);

        $user->gyms()->syncWithoutDetaching([
            $gym->id => ['role' => $role->name],
        ]);

        $user->syncRoles([$role]);
        $user->unsetRelation('roles');
        $user->unsetRelation('permissions');
    }

    public static function currentRoleName(User $user, ?Gym $gym = null): ?string
    {
        $gym ??= self::firstGym($user);

        if (! $gym) {
            return null;
        }

        self::setPermissionsTeamId($gym->id);

        return $user->roles()
            ->where('guard_name', 'web')
            ->whereNull('roles.gym_id')
            ->value('name');
    }

    public static function firstGym(User $user): ?Gym
    {
        return $user->gyms()
            ->orderBy('gyms.id')
            ->first();
    }

    public static function setPermissionsTeamId(int $gymId): void
    {
        if (function_exists('setPermissionsTeamId')) {
            setPermissionsTeamId($gymId);
        }

        app(PermissionRegistrar::class)->setPermissionsTeamId($gymId);
    }

    public static function resolveRole(string $roleName): Role
    {
        $role = Role::query()
            ->where('name', $roleName)
            ->where('guard_name', 'web')
            ->whereNull('roles.gym_id')
            ->first();

        if ($role instanceof Role) {
            return $role;
        }

        throw new InvalidArgumentException("Business role [{$roleName}] does not exist. Create it in /system/shield/roles first.");
    }
}
