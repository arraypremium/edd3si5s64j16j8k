<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Drop any Spatie role/permission mappings linked to SystemAdmin
        if (Schema::hasTable('model_has_roles')) {
            DB::table('model_has_roles')->where('model_type', 'App\Models\SystemAdmin')->delete();
        }

        if (Schema::hasTable('model_has_permissions')) {
            DB::table('model_has_permissions')->where('model_type', 'App\Models\SystemAdmin')->delete();
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // No-op
    }
};
