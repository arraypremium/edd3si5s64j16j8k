<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

// Mark subscriptions expired every day at 00:00
Schedule::command('gymie:subscriptions')
    ->dailyAt('00:00');

// Mark invoices overdue every day at 00:00
Schedule::command('gymie:invoices --mark-overdue')
    ->dailyAt('00:00');

// Clean old generated backup/export/import temporary files daily.
Schedule::command('gymie:cleanup-backups --hours=48')
    ->dailyAt('01:00');

// Sync gym subscription status daily at 00:00
Schedule::command('gymie:sync-gym-subscription-status')
    ->dailyAt('00:00');

// (Prompt 6.3) Daily 10-day expiry notifications for BOTH system admins
// and gym owners. Runs at 08:00 (after midnight batch jobs complete).
Schedule::command('gymie:notify-expiring-gym-subscriptions --days=10')
    ->dailyAt('08:00')
    ->withoutOverlapping()
    ->onOneServer()
    ->runInBackground();