<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('roles')) {
            $systemGuardRoleIds = DB::table('roles')
                ->where('guard_name', 'system_admin')
                ->pluck('id');

            if ($systemGuardRoleIds->isNotEmpty()) {
                if (Schema::hasTable('model_has_roles')) {
                    DB::table('model_has_roles')->whereIn('role_id', $systemGuardRoleIds)->delete();
                }

                if (Schema::hasTable('role_has_permissions')) {
                    DB::table('role_has_permissions')->whereIn('role_id', $systemGuardRoleIds)->delete();
                }

                DB::table('roles')->whereIn('id', $systemGuardRoleIds)->delete();
            }
        }

        if (Schema::hasTable('permissions')) {
            $subjects = [
                'Gym',
                'GymSubscription',
                'SystemAdmin',
                'SystemPlan',
                'SystemRole',
                'Role',
                'User',
            ];

            $permissionIds = DB::table('permissions')
                ->where('guard_name', 'system_admin')
                ->orWhere(function ($query) use ($subjects): void {
                    foreach ($subjects as $subject) {
                        $query->orWhere('name', 'like', '%:' . $subject);
                    }
                })
                ->pluck('id');

            if ($permissionIds->isNotEmpty()) {
                if (Schema::hasTable('role_has_permissions')) {
                    DB::table('role_has_permissions')->whereIn('permission_id', $permissionIds)->delete();
                }

                if (Schema::hasTable('model_has_permissions')) {
                    DB::table('model_has_permissions')->whereIn('permission_id', $permissionIds)->delete();
                }

                DB::table('permissions')->whereIn('id', $permissionIds)->delete();
            }
        }
    }

    public function down(): void
    {
        // Permissions/roles removed intentionally; no automatic rollback.
    }
};
