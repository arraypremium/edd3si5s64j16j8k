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
        if (! Schema::hasTable('gyms')) {
            Schema::create('gyms', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->string('contact_email')->nullable();
                $table->string('contact_phone')->nullable();
                $table->string('owner_name')->nullable();
                $table->string('owner_number')->nullable();
                $table->string('owner_email')->nullable();
                $table->text('description')->nullable();
                $table->text('address')->nullable();
                $table->string('assigned_id', 6)->nullable()->unique();
                $table->enum('status', ['active', 'suspended', 'inactive'])->default('active');
                $table->softDeletes();
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gyms');
    }
};
