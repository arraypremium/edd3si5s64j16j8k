<?php

namespace Tests\Feature;

use Tests\BaseGymieTest;

class BusinessSlugLoginTest extends BaseGymieTest
{
    public function test_feature_four_business_slug_login_files_are_wired(): void
    {
        $routes = $this->fileContents('routes/web.php');
        $controller = $this->fileContents('app/Http/Controllers/BusinessSlugLoginController.php');
        $gymResource = $this->fileContents('app/Filament/Resources/GymResource.php');
        $listGyms = $this->fileContents('app/Filament/Resources/GymResource/Pages/ListGyms.php');
        $provider = $this->fileContents('app/Providers/Filament/AdminPanelProvider.php');
        $customLogin = $this->fileContents('app/Filament/Pages/Auth/CustomLogin.php');
        $migration = $this->fileContents('database/migrations/2026_06_25_000003_add_url_slug_to_gyms_table.php');

        $this->assertStringContainsString('/{business:url_slug}/login', $routes);
        $this->assertStringContainsString('BusinessSlugLoginController::class', $routes);
        $this->assertStringContainsString('ReservedBusinessSlug::routePattern()', $routes);
        $this->assertStringContainsString('userBelongsToBusiness', $controller);
        $this->assertStringContainsString("session()->put('active_gym_id'", $controller);
        $this->assertStringContainsString('Dashboard::getUrl(tenant: $business)', $controller);
        $this->assertStringContainsString("TextInput::make('url_slug')", $gymResource);
        $this->assertStringContainsString('new ReservedBusinessSlug', $gymResource);
        $this->assertStringContainsString("->unique(Gym::class, 'url_slug'", $gymResource);
        $this->assertStringContainsString("->label('New Business')", $listGyms);
        $this->assertStringContainsString("slugAttribute: 'url_slug'", $provider);
        $this->assertStringContainsString('__business_slug_login_required__', $customLogin);
        $this->assertStringContainsString("->unique('url_slug'", $migration);

        $this->logPass(__FUNCTION__);
    }

    public function test_feature_four_mandatory_temp_data_contains_business_slugs(): void
    {
        $seeder = $this->fileContents('database/seeders/MandatoryTemporaryTestDataSeeder.php');
        $testRunner = $this->fileContents('tests/test.sh');

        $this->assertStringContainsString("'business-one'", $seeder);
        $this->assertStringContainsString("'business-two'", $seeder);
        $this->assertStringContainsString("'a', 'a'", $seeder);
        $this->assertStringContainsString("'b', 'b'", $seeder);
        $this->assertStringContainsString("'c', 'c'", $seeder);
        $this->assertStringContainsString('db:seed --class=MandatoryTemporaryTestDataSeeder --env=testing', $testRunner);
        $this->assertTrue(strpos($testRunner, 'migrate:fresh --seed --env=testing') < strpos($testRunner, 'MandatoryTemporaryTestDataSeeder'));

        $this->logPass(__FUNCTION__);
    }

    public function test_feature_four_reserved_slug_rule_blocks_generic_paths(): void
    {
        $rule = $this->fileContents('app/Rules/ReservedBusinessSlug.php');

        foreach (['system', 'api', 'login', 'logout', 'livewire', 'storage', 'build', 'vendor'] as $reserved) {
            $this->assertStringContainsString("'{$reserved}'", $rule);
        }

        $this->assertStringContainsString('Str::slug($value)', $rule);
        $this->assertStringContainsString('routePattern', $rule);
        $this->assertStringContainsString('isReserved', $rule);

        $this->logPass(__FUNCTION__);
    }
}
