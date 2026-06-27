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
            if (! Schema::hasColumn('gyms', 'owner_name')) {
                $table->string('owner_name')->nullable();
            }
            if (! Schema::hasColumn('gyms', 'owner_number')) {
                $table->string('owner_number')->nullable();
            }
            if (! Schema::hasColumn('gyms', 'owner_email')) {
                $table->string('owner_email')->nullable();
            }
            if (! Schema::hasColumn('gyms', 'description')) {
                $table->text('description')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('gyms', function (Blueprint $table) {
            $table->dropColumn(['owner_name', 'owner_number', 'owner_email', 'description']);
        });
    }
};
