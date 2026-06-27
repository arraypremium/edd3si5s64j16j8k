<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $columnNames = config('permission.column_names');
        $teamKey = $columnNames['team_foreign_key'] ?? 'gym_id';

        // Add nullable team ID with default 1 to 'roles' table
        if (Schema::hasTable('roles')) {
            Schema::table('roles', function (Blueprint $table) use ($teamKey) {
                if (! Schema::hasColumn('roles', $teamKey)) {
                    $table->unsignedBigInteger($teamKey)->nullable()->default(1);
                    $table->index($teamKey, 'roles_team_foreign_key_index');
                }
            });
        }

        // Add nullable team ID with default 1 to 'model_has_roles' pivot table
        if (Schema::hasTable('model_has_roles')) {
            Schema::table('model_has_roles', function (Blueprint $table) use ($teamKey) {
                if (! Schema::hasColumn('model_has_roles', $teamKey)) {
                    $table->unsignedBigInteger($teamKey)->nullable()->default(1);
                    $table->index($teamKey, 'model_has_roles_team_foreign_key_index');
                }
            });
        }

        // Add nullable team ID with default 1 to 'model_has_permissions' pivot table
        if (Schema::hasTable('model_has_permissions')) {
            Schema::table('model_has_permissions', function (Blueprint $table) use ($teamKey) {
                if (! Schema::hasColumn('model_has_permissions', $teamKey)) {
                    $table->unsignedBigInteger($teamKey)->nullable()->default(1);
                    $table->index($teamKey, 'model_has_permissions_team_foreign_key_index');
                }
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $columnNames = config('permission.column_names');
        $teamKey = $columnNames['team_foreign_key'] ?? 'gym_id';

        if (Schema::hasTable('roles')) {
            Schema::table('roles', function (Blueprint $table) use ($teamKey) {
                if (Schema::hasColumn('roles', $teamKey)) {
                    $table->dropColumn($teamKey);
                }
            });
        }

        if (Schema::hasTable('model_has_roles')) {
            Schema::table('model_has_roles', function (Blueprint $table) use ($teamKey) {
                if (Schema::hasColumn('model_has_roles', $teamKey)) {
                    $table->dropColumn($teamKey);
                }
            });
        }

        if (Schema::hasTable('model_has_permissions')) {
            Schema::table('model_has_permissions', function (Blueprint $table) use ($teamKey) {
                if (Schema::hasColumn('model_has_permissions', $teamKey)) {
                    $table->dropColumn($teamKey);
                }
            });
        }
    }
};