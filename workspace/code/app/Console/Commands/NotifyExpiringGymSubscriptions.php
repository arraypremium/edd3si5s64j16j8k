<?php

namespace App\Console\Commands;

use App\Models\Gym;
use App\Notifications\ExpiringGymSubscriptionNotification;
use App\Support\AppConfig;
use Carbon\Carbon;
use Illuminate\Console\Command;

/**
 * Daily command: detects gyms whose subscriptions expire within N days
 * (default 10) and dispatches notifications to BOTH system admins and
 * gym owners/managers.
 *
 * (Prompt 6.2 — Dedicated expiry notification command)
 */
class NotifyExpiringGymSubscriptions extends Command
{
    protected $signature = 'gymie:notify-expiring-gym-subscriptions {--days=10}';

    protected $description = 'Send daily notification for gym subscriptions expiring within N days';

    public function handle(): int
    {
        $days = (int) $this->option('days');

        if ($days < 1) {
            $this->error('--days must be >= 1');
            return self::FAILURE;
        }

        $timezone = AppConfig::timezone();
        $today = Carbon::today($timezone);
        $threshold = $today->copy()->addDays($days);

        // (Security) Filter out:
        //  - Gyms with NULL expiry_date
        //  - Already-expired gyms (avoid spam)
        //  - Suspended gyms (no point notifying)
        $gyms = Gym::query()
            ->whereNotNull('expiry_date')
            ->whereBetween('expiry_date', [$today->toDateString(), $threshold->toDateString()])
            ->where(function ($q) use ($today) {
                $q->whereNull('subscription_status')
                    ->orWhere('subscription_status', '!=', 'expired');
            })
            ->where('status', '!=', 'suspended')
            ->get();

        if ($gyms->isEmpty()) {
            $this->info("No business subscriptions expiring within {$days} days.");
            return self::SUCCESS;
        }

        $count = 0;
        foreach ($gyms as $gym) {
            $daysRemaining = (int) $today->diffInDays($gym->expiry_date, false);
            // diffInDays may return negative if same-day; clamp to 0
            $daysRemaining = max(0, $daysRemaining);

            // Dispatch to BOTH system admins and gym owners
            ExpiringGymSubscriptionNotification::sendToSystemAdmins($gym, $daysRemaining);
            ExpiringGymSubscriptionNotification::sendToGymOwners($gym, $daysRemaining);

            $count++;
            $this->info("✓ Notified: {$gym->name} ({$daysRemaining} day(s) remaining)");
        }

        $this->info("Total: {$count} business(es) notified.");

        return self::SUCCESS;
    }
}