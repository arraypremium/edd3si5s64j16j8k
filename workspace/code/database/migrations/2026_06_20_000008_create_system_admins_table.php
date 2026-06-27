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
        if (! Schema::hasTable('system_admins')) {
            Schema::create('system_admins', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->string('username')->unique();
                $table->string('password');
                $table->string('status')->default('active');
                $table->rememberToken();
                $table->softDeletes();
                $table->timestamps();
            });
        }

        // Seed the initial System Administrator safely using raw DB to avoid composer/PSR-4 autoload issues during migration execution
        DB::table('system_admins')->updateOrInsert(
            ['username' => 'admin'],
            [
                'name' => 'System Administrator',
                'password' => \Illuminate\Support\Facades\Hash::make('Admin@12345'),
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('system_admins');
    }
};
