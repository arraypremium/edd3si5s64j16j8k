<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasTable('gym_subscriptions')) {
            return;
        }

        $hasStatus = Schema::hasColumn('gym_subscriptions', 'status');
        $hasPaymentStatus = Schema::hasColumn('gym_subscriptions', 'payment_status');
        $hasAmountPaid = Schema::hasColumn('gym_subscriptions', 'amount_paid');
        $hasPaymentMethod = Schema::hasColumn('gym_subscriptions', 'payment_method');

        if (! $hasStatus) {
            Schema::table('gym_subscriptions', function (Blueprint $table) {
                $table->enum('status', ['ongoing', 'expired', 'upcoming', 'cancelled'])
                    ->default('upcoming')
                    ->index()
                    ->after('end_date');
            });
        }

        $columnsToDrop = [];

        if ($hasPaymentMethod) {
            $columnsToDrop[] = 'payment_method';
        }

        if ($hasAmountPaid) {
            $columnsToDrop[] = 'amount_paid';
        }

        if ($hasPaymentStatus) {
            $columnsToDrop[] = 'payment_status';
        }

        if ($columnsToDrop !== []) {
            Schema::table('gym_subscriptions', function (Blueprint $table) use ($columnsToDrop) {
                $table->dropColumn($columnsToDrop);
            });
        }
    }

    public function down(): void
    {
        if (! Schema::hasTable('gym_subscriptions')) {
            return;
        }

        $hasStatus = Schema::hasColumn('gym_subscriptions', 'status');

        Schema::table('gym_subscriptions', function (Blueprint $table) use ($hasStatus) {
            if ($hasStatus) {
                $table->dropColumn(['status']);
            }
        });
    }
};
