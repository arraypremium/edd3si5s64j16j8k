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
        // 1. Permanently delete any soft-deleted gyms to free up unique IDs (assigned_id) in MySQL
        if (Schema::hasTable('gyms') && Schema::hasColumn('gyms', 'deleted_at')) {
            DB::table('gyms')->whereNotNull('deleted_at')->delete();
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
