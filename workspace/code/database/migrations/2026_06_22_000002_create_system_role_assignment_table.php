<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('system_role_assignment', function (Blueprint $table) {
            $table->id();
            $table->foreignId('system_admin_id')
                ->constrained('system_admins')
                ->cascadeOnDelete();
            $table->foreignId('system_role_id')
                ->constrained('system_roles')
                ->cascadeOnDelete();
            $table->timestamps();

            $table->unique(['system_admin_id', 'system_role_id'], 'sra_unique');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('system_role_assignment');
    }
};