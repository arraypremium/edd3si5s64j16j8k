<?php

namespace Tests\Feature;

use Tests\BaseGymieTest;

class SubscriptionTest extends BaseGymieTest
{
    public function test_subscription_feature_files_remain_present_after_feature_one(): void
    {
        $this->assertFileExists($this->projectFile('app/Filament/Resources/Subscriptions/SubscriptionResource.php'));
        $this->assertFileExists($this->projectFile('app/Services/Subscriptions/SubscriptionRenewalService.php'));
        $this->logPass(__FUNCTION__);
    }
}
