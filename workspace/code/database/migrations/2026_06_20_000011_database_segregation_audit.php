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
        // 1. Audit and drop 'email' column from 'users' table if it exists
        if (Schema::hasTable('users')) {
            Schema::table('users', function (Blueprint $table) {
                if (Schema::hasColumn('users', 'email')) {
                    $table->dropColumn('email');
                }
            });
        }

        // 2. Audit and drop 'logo' column from 'gyms' table if it exists
        if (Schema::hasTable('gyms')) {
            Schema::table('gyms', function (Blueprint $table) {
                if (Schema::hasColumn('gyms', 'logo')) {
                    $table->dropColumn('logo');
                }
            });
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
