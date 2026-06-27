<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Smart check: Agar gym_user table pehle se hai, toh bina error ke aage nikal jao
        if (! Schema::hasTable('gym_user')) {
            Schema::create('gym_user', function (Blueprint $table) {
                $table->id();
                $table->foreignId('gym_id')->constrained('gyms')->onDelete('cascade');
                $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
                $table->string('role')->nullable();
                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('gym_user');
    }
};