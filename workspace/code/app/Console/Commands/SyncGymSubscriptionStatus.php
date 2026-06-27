<?php

namespace App\Console\Commands;

use App\Models\Gym;
use Illuminate\Console\Command;

class SyncGymSubscriptionStatus extends Command
{
    protected $signature = 'gymie:sync-gym-subscription-status';

    protected $description = 'Sync gym subscription status and expiry date for all gyms';

    public function handle(): int
    {
        $count = 0;

        Gym::chunk(100, function ($gyms) use (&$count) {
            foreach ($gyms as $gym) {
                $gym->syncSubscriptionStatus();
                $count++;
            }
        });

        $this->info("Synced subscription status for {$count} gyms.");

        return self::SUCCESS;
    }
}
