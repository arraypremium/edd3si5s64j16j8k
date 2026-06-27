<?php

namespace App\Observers;

use App\Models\GymSubscription;

class GymSubscriptionObserver
{
    public function created(GymSubscription $subscription): void
    {
        $subscription->gym?->syncSubscriptionStatus();
    }

    public function updated(GymSubscription $subscription): void
    {
        $subscription->gym?->syncSubscriptionStatus();
    }

    public function deleted(GymSubscription $subscription): void
    {
        $subscription->gym?->syncSubscriptionStatus();
    }
}
