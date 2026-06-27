<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * One-time cleanup: Remove duplicate global roles (gym_id = null)
     * keeping the OLDEST per (name, guard_name) combo.
     *
     * Migrates pivot rows BEFORE deleting duplicates (no FK violations).
     */
    public function up(): void
    {
        // Find all duplicate global role groups
        $duplicates = DB::table('roles')
            ->select('name', 'guard_name', DB::raw('COUNT(*) as cnt'))
            ->whereNull('gym_id')
            ->groupBy('name', 'guard_name')
            ->havingRaw('COUNT(*) > 1')
            ->get();

        if ($duplicates->isEmpty()) {
            return;
        }

        foreach ($duplicates as $dup) {
            // Keep the OLDEST role per group
            $keepId = DB::table('roles')
                ->where('name', $dup->name)
                ->where('guard_name', $dup->guard_name)
                ->whereNull('gym_id')
                ->orderBy('id', 'asc')
                ->value('id');

            // Find all duplicate IDs (NOT the kept one)
            $duplicateIds = DB::table('roles')
                ->where('name', $dup->name)
                ->where('guard_name', $dup->guard_name)
                ->whereNull('gym_id')
                ->where('id', '!=', $keepId)
                ->pluck('id');

            if ($duplicateIds->isEmpty()) {
                continue;
            }

            // Step 1: Migrate pivot rows pointing to duplicates → point to kept one
            // (Only update if a pivot row with same (model_id, model_type, gym_id) doesn't already exist for kept role)
            foreach ($duplicateIds as $dupId) {
                $pivotRows = DB::table('model_has_roles')
                    ->where('role_id', $dupId)
                    ->get();

                foreach ($pivotRows as $pivot) {
                    $exists = DB::table('model_has_roles')
                        ->where('role_id', $keepId)
                        ->where('model_id', $pivot->model_id)
                        ->where('model_type', $pivot->model_type)
                        ->exists();

                    if (! $exists) {
                        DB::table('model_has_roles')
                            ->where('role_id', $dupId)
                            ->where('model_id', $pivot->model_id)
                            ->where('model_type', $pivot->model_type)
                            ->update(['role_id' => $keepId]);
                    } else {
                        // Duplicate pivot row — safe to delete
                        DB::table('model_has_roles')
                            ->where('role_id', $dupId)
                            ->where('model_id', $pivot->model_id)
                            ->where('model_type', $pivot->model_type)
                            ->delete();
                    }
                }
            }

            // Step 2: Now safe to delete the duplicate roles
            DB::table('roles')->whereIn('id', $duplicateIds)->delete();
        }
    }

    /**
     * No rollback — duplicates deleted intentionally.
     */
    public function down(): void
    {
        // Intentionally empty: cannot restore deleted duplicates.
    }
};
