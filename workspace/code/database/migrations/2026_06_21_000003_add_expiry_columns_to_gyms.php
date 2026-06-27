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
            $table->date('expiry_date')->nullable()->index()->after('status');
            $table->unsignedBigInteger('system_plan_id')->nullable()->index()->after('expiry_date');
            $table->enum('subscription_status', ['active', 'expired', 'none'])->default('none')->index()->after('system_plan_id');

            $table->foreign('system_plan_id')
                ->references('id')
                ->on('system_plans')
                ->onDelete('set null');

            $table->index(['expiry_date', 'subscription_status']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('gyms', function (Blueprint $table) {
            $table->dropIndex(['expiry_date', 'subscription_status']);
            $table->dropForeign(['system_plan_id']);
            $table->dropIndex(['system_plan_id']);
            $table->dropIndex(['expiry_date']);
            $table->dropIndex(['subscription_status']);
            $table->dropColumn(['expiry_date', 'system_plan_id', 'subscription_status']);
        });
    }
};
