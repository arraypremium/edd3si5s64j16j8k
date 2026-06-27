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
        Schema::create('gym_subscriptions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('gym_id');
            $table->unsignedBigInteger('system_plan_id');
            $table->date('start_date');
            $table->date('end_date');
            $table->enum('status', ['ongoing', 'expired', 'upcoming', 'cancelled'])->default('upcoming')->index();
            $table->timestamps();

            $table->foreign('gym_id')
                ->references('id')
                ->on('gyms')
                ->onDelete('cascade');

            $table->foreign('system_plan_id')
                ->references('id')
                ->on('system_plans')
                ->onDelete('restrict');

            $table->index(['gym_id', 'status']);
            $table->index(['end_date']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gym_subscriptions');
    }
};
