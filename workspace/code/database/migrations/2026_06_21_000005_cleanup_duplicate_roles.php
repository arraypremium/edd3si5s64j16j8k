<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 1. Ensure a global super_admin exists (gym_id IS NULL)
        $globalSuperAdmin = DB::table('roles')
            ->where('name', 'super_admin')
            ->whereNull('gym_id')
            ->first();

        if (! $globalSuperAdmin) {
            $oldest = DB::table('roles')
                ->where('name', 'super_admin')
                ->orderBy('id', 'asc')
                ->first();

            if ($oldest) {
                DB::table('roles')
                    ->where('id', $oldest->id)
                    ->update(['gym_id' => null]);
                $globalSuperAdmin = $oldest;
            }
        }

        // 2. Ensure a global panel_user exists (gym_id IS NULL)
        $globalPanelUser = DB::table('roles')
            ->where('name', 'panel_user')
            ->whereNull('gym_id')
            ->first();

        if (! $globalPanelUser) {
            $oldest = DB::table('roles')
                ->where('name', 'panel_user')
                ->orderBy('id', 'asc')
                ->first();

            if ($oldest) {
                DB::table('roles')
                    ->where('id', $oldest->id)
                    ->update(['gym_id' => null]);
                $globalPanelUser = $oldest;
            }
        }

        // 3. Reassign all model_has_roles from duplicate super_admins to global
        if ($globalSuperAdmin) {
            $duplicateSuperAdmins = DB::table('roles')
                ->where('name', 'super_admin')
                ->whereNotNull('gym_id')
                ->pluck('id');

            foreach ($duplicateSuperAdmins as $dupId) {
                DB::table('model_has_roles')
                    ->where('role_id', $dupId)
                    ->update(['role_id' => $globalSuperAdmin->id ?? $globalSuperAdmin['id']]);
            }

            DB::table('roles')
                ->where('name', 'super_admin')
                ->whereNotNull('gym_id')
                ->delete();
        }

        // 4. Reassign all model_has_roles from duplicate panel_users to global
        if ($globalPanelUser) {
            $duplicatePanelUsers = DB::table('roles')
                ->where('name', 'panel_user')
                ->whereNotNull('gym_id')
                ->pluck('id');

            foreach ($duplicatePanelUsers as $dupId) {
                DB::table('model_has_roles')
                    ->where('role_id', $dupId)
                    ->update(['role_id' => $globalPanelUser->id ?? $globalPanelUser['id']]);
            }

            DB::table('roles')
                ->where('name', 'panel_user')
                ->whereNotNull('gym_id')
                ->delete();
        }

        // 5. Delete any orphaned roles (no model_has_roles referencing them)
        $orphanRoleIds = DB::table('roles')
            ->whereNotIn('id', function ($query) {
                $query->select('role_id')->from('model_has_roles');
            })
            ->pluck('id');

        if ($orphanRoleIds->isNotEmpty()) {
            DB::table('roles')->whereIn('id', $orphanRoleIds)->delete();
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Not reversible — data cleanup migration
    }
};
