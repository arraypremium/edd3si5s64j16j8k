<?php

namespace App\Console\Commands;

use App\Helpers\Helpers;
use App\Models\Gym;
use App\Models\Subscription;
use App\Models\User;
use Carbon\Carbon;
use Filament\Notifications\Notification;
use Illuminate\Console\Command;

class MarkSubscriptionsStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'gymie:subscriptions
                            {--mark-expired : Mark expired subscriptions}
                            {--mark-expiring : Mark subscriptions expiring within the configured window}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Mark subscriptions as expiring or expired and notify tailored facility management';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $timezone = \App\Support\AppConfig::timezone();
        $today = Carbon::today($timezone);
        $expiringDays = Helpers::getSubscriptionExpiringDays();
        $expiringThreshold = $today->copy()->addDays($expiringDays);

        $summary = [];
        $gymAlerts = [];

        $runExpiredOnly = (bool) $this->option('mark-expired');
        $runExpiringOnly = (bool) $this->option('mark-expiring');
        $runAll = ! $runExpiredOnly && ! $runExpiringOnly;

        if ($runAll || $runExpiredOnly) {
            $expiredSubs = Subscription::query()
                ->whereDate('end_date', '<', $today)
                ->whereNotIn('status', ['expired', 'renewed'])
                ->whereDoesntHave('renewals')
                ->get();

            if ($expiredSubs->isNotEmpty()) {
                Subscription::query()
                    ->whereIn('id', $expiredSubs->pluck('id'))
                    ->update(['status' => 'expired']);

                $summary[] = "{$expiredSubs->count()} expired";

                foreach ($expiredSubs->groupBy('gym_id') as $gymId => $subs) {
                    if (filled($gymId)) {
                        $gymAlerts[$gymId][] = "{$subs->count()} subscription(s) expired";
                    }
                }
            }
        }

        if ($runAll || $runExpiredOnly) {
            $renewedSubs = Subscription::query()
                ->whereDate('end_date', '<', $today)
                ->where('status', '!=', 'renewed')
                ->whereHas('renewals')
                ->get();

            if ($renewedSubs->isNotEmpty()) {
                Subscription::query()
                    ->whereIn('id', $renewedSubs->pluck('id'))
                    ->update(['status' => 'renewed']);

                $summary[] = "{$renewedSubs->count()} renewed";

                foreach ($renewedSubs->groupBy('gym_id') as $gymId => $subs) {
                    if (filled($gymId)) {
                        $gymAlerts[$gymId][] = "{$subs->count()} subscription(s) successfully renewed";
                    }
                }
            }
        }

        if ($runAll) {
            $upcomingSubs = Subscription::query()
                ->whereDate('start_date', '>', $today)
                ->where('status', '!=', 'renewed')
                ->where('status', '!=', 'upcoming')
                ->get();

            if ($upcomingSubs->isNotEmpty()) {
                Subscription::query()
                    ->whereIn('id', $upcomingSubs->pluck('id'))
                    ->update(['status' => 'upcoming']);

                $summary[] = "{$upcomingSubs->count()} upcoming";
            }
        }

        if ($runAll || $runExpiringOnly) {
            $expiringSubs = Subscription::query()
                ->whereDate('start_date', '<=', $today)
                ->whereBetween('end_date', [$today->toDateString(), $expiringThreshold->toDateString()])
                ->where('status', '!=', 'renewed')
                ->where('status', '!=', 'expiring')
                ->where('status', '!=', 'expired')
                ->get();

            if ($expiringSubs->isNotEmpty()) {
                Subscription::query()
                    ->whereIn('id', $expiringSubs->pluck('id'))
                    ->update(['status' => 'expiring']);

                $summary[] = "{$expiringSubs->count()} expiring (≤ {$expiringDays} days)";

                foreach ($expiringSubs->groupBy('gym_id') as $gymId => $subs) {
                    if (filled($gymId)) {
                        $gymAlerts[$gymId][] = "{$subs->count()} subscription(s) expiring soon";
                    }
                }
            }
        }

        if ($runAll) {
            $ongoingSubs = Subscription::query()
                ->whereDate('start_date', '<=', $today)
                ->whereDate('end_date', '>', $expiringThreshold)
                ->whereNotIn('status', ['ongoing', 'expired', 'renewed'])
                ->get();

            if ($ongoingSubs->isNotEmpty()) {
                Subscription::query()
                    ->whereIn('id', $ongoingSubs->pluck('id'))
                    ->update(['status' => 'ongoing']);

                $summary[] = "{$ongoingSubs->count()} ongoing";
            }
        }

        if (empty($summary)) {
            $this->info('No subscription statuses needed updating.');

            return self::SUCCESS;
        }

        foreach ($summary as $line) {
            $this->info("• {$line}");
        }

        // Dispatch customized facility alerts
        foreach ($gymAlerts as $gymId => $lines) {
            $gym = Gym::find($gymId);
            if ($gym) {
                $facilityManagers = $gym->users()->wherePivotIn('role', ['owner', 'manager'])->get();
                foreach ($facilityManagers as $manager) {
                    Notification::make()
                        ->title("Facility Subscriptions Update: " . $gym->name)
                        ->body("Automated nightly processing log:\n• " . implode("\n• ", $lines))
                        ->info()
                        ->sendToDatabase($manager);
                }
            }
        }

        // Broadcast master summary to Site Super Admin
        $admin = User::role('super_admin')->first();
        if ($admin) {
            Notification::make()
                ->title(__('app.notifications.subscription_status_update_title'))
                ->body(__('app.notifications.subscription_status_update_body', ['summary' => implode(', ', $summary)]))
                ->info()
                ->sendToDatabase($admin);
        }

        // (Prompt 6.4) After all subscription status updates, trigger the
        // dedicated 10-day expiry notification command. This keeps logic
        // in one place (NotifyExpiringGymSubscriptions) and respects the
        // daily cron schedule at 08:00.
        if ($runAll) {
            \Illuminate\Support\Facades\Artisan::call('gymie:notify-expiring-gym-subscriptions', ['--days' => 10]);
            $this->info('• Triggered 10-day expiry notifications');
        }

        return self::SUCCESS;
    }
}
