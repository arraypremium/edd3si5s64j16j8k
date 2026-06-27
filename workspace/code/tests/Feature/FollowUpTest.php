<?php

namespace Tests\Feature;

use Tests\BaseGymieTest;

class FollowUpTest extends BaseGymieTest
{
    public function test_follow_up_feature_files_remain_present_after_feature_one(): void
    {
        $this->assertFileExists($this->projectFile('app/Filament/Resources/FollowUps/FollowUpResource.php'));
        $this->assertFileExists($this->projectFile('app/Filament/Resources/Enquiries/RelationManagers/FollowUpsRelationManager.php'));
        $this->logPass(__FUNCTION__);
    }
}
