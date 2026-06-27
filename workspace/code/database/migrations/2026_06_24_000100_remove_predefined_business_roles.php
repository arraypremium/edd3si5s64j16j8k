<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        $predefinedRoles = [
            'owner',
            'manager',
            'staff',
            'receptionist',
            'trainer',
            'panel_user',
            'super_admin',
        ];

        if (Schema::hasTable('roles')) {
            $roleIds = DB::table('roles')
                ->where('guard_name', 'web')
                ->whereIn('name', $predefinedRoles)
                ->pluck('id');

            if ($roleIds->isNotEmpty()) {
                if (Schema::hasTable('model_has_roles')) {
                    DB::table('model_has_roles')->whereIn('role_id', $roleIds)->delete();
                }

                if (Schema::hasTable('role_has_permissions')) {
                    DB::table('role_has_permissions')->whereIn('role_id', $roleIds)->delete();
                }

                DB::table('roles')->whereIn('id', $roleIds)->delete();
            }

            try {
                DB::statement('ALTER TABLE roles MODIFY gym_id BIGINT UNSIGNED NULL DEFAULT NULL');
            } catch (\Throwable $e) {
                // Ignore engines that do not support this ALTER syntax.
            }
        }

        if (Schema::hasTable('gym_user') && Schema::hasColumn('gym_user', 'role')) {
            DB::table('gym_user')
                ->whereIn('role', $predefinedRoles)
                ->update(['role' => null]);
        }
    }

    public function down(): void
    {
        // Predefined roles are intentionally not recreated.
    }
};
