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
        Schema::table('gyms', function (Blueprint $table) {
            if (! Schema::hasColumn('gyms', 'assigned_id')) {
                $table->string('assigned_id', 6)->nullable()->unique();
            }
            if (Schema::hasColumn('gyms', 'logo')) {
                $table->dropColumn('logo');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('gyms', function (Blueprint $table) {
            $table->string('logo')->nullable();
            $table->dropColumn('assigned_id');
        });
    }
};
