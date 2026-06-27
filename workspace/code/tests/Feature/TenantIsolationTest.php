<?php

namespace Tests\Feature;

use Tests\BaseGymieTest;

class TenantIsolationTest extends BaseGymieTest
{
    public function test_tenant_isolation_trait_remains_present_after_feature_one(): void
    {
        $contents = $this->fileContents('app/Models/Concerns/BelongsToGym.php');
        $this->assertStringContainsString('bootBelongsToGym', $contents);
        $this->assertStringContainsString('gym_id', $contents);
        $this->logPass(__FUNCTION__);
    }

    public function test_feature_four_slug_login_preserves_tenant_isolation_contract(): void
    {
        $controller = $this->fileContents('app/Http/Controllers/BusinessSlugLoginController.php');
        $middleware = $this->fileContents('app/Http/Middleware/CheckGymStatus.php');
        $seeder = $this->fileContents('database/seeders/MandatoryTemporaryTestDataSeeder.php');

        $this->assertStringContainsString('userBelongsToBusiness', $controller);
        $this->assertStringContainsString('gyms()->whereKey($business->id)->exists()', $controller);
        $this->assertStringContainsString("session()->put('active_gym_id'", $controller);
        $this->assertStringContainsString('setPermissionsTeamId($business->id)', $controller);
        $this->assertStringContainsString('setPermissionsTeamId($tenant->id)', $middleware);
        $this->assertStringContainsString("'business-one'", $seeder);
        $this->assertStringContainsString("'business-two'", $seeder);

        $this->logPass(__FUNCTION__);
    }
}
