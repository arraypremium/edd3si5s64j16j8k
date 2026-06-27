<?php

namespace Tests\Feature;

use Tests\BaseGymieTest;

class RolePermissionTest extends BaseGymieTest
{
    public function test_role_and_permission_files_remain_present_after_feature_one(): void
    {
        $this->assertFileExists($this->projectFile('app/Support/Roles/BusinessRoleManager.php'));
        $this->assertFileExists($this->projectFile('config/permission.php'));
        $this->logPass(__FUNCTION__);
    }
}
