<?php

namespace Tests\Regression;

use Tests\BaseGymieTest;

class RegressionTest extends BaseGymieTest
{
    public function test_feature_one_source_and_goal_regression_contract(): void
    {
        $enquiryMigration = $this->fileContents('database/migrations/2025_05_26_020228_create_enquiries_table.php');
        $memberMigration = $this->fileContents('database/migrations/2025_06_10_101915_create_members_table.php');
        $newMigration = $this->fileContents('database/migrations/2026_06_25_000001_remove_goal_and_update_sources_on_members_and_enquiries.php');

        $this->assertStringNotContainsString("string('goal')", $enquiryMigration);
        $this->assertStringNotContainsString("string('goal')", $memberMigration);
        $this->assertStringContainsString("default('word_of_mouth')", $memberMigration);
        $this->assertStringContainsString("dropColumn('goal')", $newMigration);
        $this->assertStringContainsString("setMembersSourceDefault('word_of_mouth')", $newMigration);

        foreach (['en', 'ar', 'fa', 'fr'] as $locale) {
            $lang = $this->fileContents("resources/lang/{$locale}/app.php");
            $this->assertStringContainsString("'word_of_mouth'", $lang);
            $this->assertStringContainsString("'google_business_account'", $lang);
            $this->assertStringNotContainsString("'goal' =>", $lang);
        }

        $this->assertFileExists($this->projectFile('app/Notifications/ExpiringGymSubscriptionNotification.php'));
        $this->assertFileExists($this->projectFile('app/Enums/FacilityRole.php'));
        $this->assertFileExists($this->projectFile('app/Http/Resources/V1/UserResource.php'));
        $this->assertStringContainsString("where('username'", $this->fileContents('app/Http/Controllers/Api/V1/AuthController.php'));
        $userResource = $this->fileContents('app/Http/Resources/V1/UserResource.php');
        $this->assertStringContainsString('includePermissions:', $userResource);
        $this->assertStringContainsString("api/v1/me", $userResource);
        $this->assertStringContainsString('runningUnitTests', $this->fileContents('app/Support/Dashboard/DashboardAccess.php'));
        $this->assertStringContainsString('sanitizeSeededGymsForTests', $this->fileContents('tests/TestCase.php'));

        $expenseForm = $this->fileContents('app/Filament/Resources/Expenses/Schemas/ExpenseForm.php');
        $this->assertStringNotContainsString('->hourMode(12)', $expenseForm);
        $this->assertStringContainsString("->displayFormat('d-m-Y h:i A')", $expenseForm);

        $helpers = $this->fileContents('app/Helpers/Helpers.php');
        foreach ([
            'Equipment Purchase',
            'Staff Commission',
            'Software and Subscription',
            'GST / Tax',
            'Photography and Videography',
            'Social Media Management',
            'Courier and Delivery',
            'Miscellaneous',
        ] as $category) {
            $this->assertStringContainsString("'{$category}'", $helpers);
        }

        $enquiryForm = $this->fileContents('app/Filament/Resources/Enquiries/Schemas/EnquiryForm.php');
        $this->assertStringContainsString("DatePicker::make('dob')", $enquiryForm);
        $this->assertStringNotContainsString("DatePicker::make('dob')
                            ->required()", $enquiryForm);

        $memberModel = $this->fileContents('app/Models/Member.php');
        $memberForm = $this->fileContents('app/Filament/Resources/Members/Schemas/MemberForm.php');
        $memberMigration = $this->fileContents('database/migrations/2026_06_25_000002_enforce_global_unique_member_codes.php');
        $generator = $this->fileContents('app/Support/Members/MemberCodeGenerator.php');

        $this->assertStringContainsString("PREFIX = 'M-'", $generator);
        $this->assertStringContainsString('RANDOM_LENGTH = 3', $generator);
        $this->assertStringContainsString('ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789', $generator);
        $this->assertStringContainsString('members_code_global_unique', $memberMigration);
        $this->assertStringNotContainsString("Helpers::generateLastNumber(\n                                        'member'", $memberForm);
        $this->assertStringNotContainsString("Helpers::generateLastNumber('member'", $memberModel);
        $this->assertStringContainsString('MemberCodeGenerator::generate()', $memberModel);

        $testRunner = $this->fileContents('tests/test.sh');
        $temporarySeeder = $this->fileContents('database/seeders/MandatoryTemporaryTestDataSeeder.php');
        $this->assertStringContainsString('SCRIPT_DIR=', $testRunner);
        $this->assertStringContainsString('PROJECT_DIR=', $testRunner);
        $this->assertStringNotContainsString('/'.'home'.'/', $testRunner);
        $this->assertStringNotContainsString('/'.'root'.'/', $testRunner);
        $this->assertStringContainsString('migrate:fresh --seed --env=testing', $testRunner);
        $this->assertStringContainsString('db:seed --class=MandatoryTemporaryTestDataSeeder --env=testing', $testRunner);
        $this->assertStringContainsString('Mandatory temporary data import', $testRunner);
        $this->assertStringContainsString("'admin'", $temporarySeeder);
        $this->assertStringContainsString("'a', 'a'", $temporarySeeder);
        $this->assertStringContainsString("'b', 'b'", $temporarySeeder);
        $this->assertStringContainsString("'c', 'c'", $temporarySeeder);
        $this->assertStringContainsString("'M-'", $temporarySeeder);
        $this->assertStringContainsString('MemberCodeGenerator::generate($ignoreMemberId)', $temporarySeeder);

        $slugMigration = $this->fileContents('database/migrations/2026_06_25_000003_add_url_slug_to_gyms_table.php');
        $gymModel = $this->fileContents('app/Models/Gym.php');
        $gymResource = $this->fileContents('app/Filament/Resources/GymResource.php');
        $listGyms = $this->fileContents('app/Filament/Resources/GymResource/Pages/ListGyms.php');
        $adminPanelProvider = $this->fileContents('app/Providers/Filament/AdminPanelProvider.php');
        $webRoutes = $this->fileContents('routes/web.php');
        $businessLoginController = $this->fileContents('app/Http/Controllers/BusinessSlugLoginController.php');
        $customLogin = $this->fileContents('app/Filament/Pages/Auth/CustomLogin.php');
        $reservedSlugRule = $this->fileContents('app/Rules/ReservedBusinessSlug.php');
        $temporarySeeder = $this->fileContents('database/seeders/MandatoryTemporaryTestDataSeeder.php');

        $this->assertStringContainsString('url_slug', $slugMigration);
        $this->assertStringContainsString('gyms_url_slug_unique', $slugMigration);
        $this->assertStringContainsString("'url_slug'", $gymModel);
        $this->assertStringContainsString("TextInput::make('url_slug')", $gymResource);
        $this->assertStringContainsString('new ReservedBusinessSlug', $gymResource);
        $this->assertStringContainsString("->label('New Business')", $listGyms);
        $this->assertStringContainsString("slugAttribute: 'url_slug'", $adminPanelProvider);
        $this->assertStringContainsString('/{business:url_slug}/login', $webRoutes);
        $this->assertStringContainsString('userBelongsToBusiness', $businessLoginController);
        $this->assertStringContainsString('__business_slug_login_required__', $customLogin);
        $this->assertStringContainsString("'system'", $reservedSlugRule);
        $this->assertStringContainsString("'api'", $reservedSlugRule);
        $this->assertStringContainsString("'business-one'", $temporarySeeder);
        $this->assertStringContainsString("'business-two'", $temporarySeeder);

        $businessRoleResource = $this->fileContents('app/Filament/Resources/BusinessRoleResource.php');
        $createBusinessRole = $this->fileContents('app/Filament/Resources/BusinessRoleResource/Pages/CreateBusinessRole.php');
        $editBusinessRole = $this->fileContents('app/Filament/Resources/BusinessRoleResource/Pages/EditBusinessRole.php');
        $businessRoleTests = $this->fileContents('tests/Feature/BusinessRoleResourceTest.php');

        $this->assertStringContainsString('sanitizeRolePersistenceData', $businessRoleResource);
        $this->assertStringContainsString('extractPermissionNamesFromFormState', $businessRoleResource);
        $this->assertStringContainsString("'name' => \$data['name'] ?? null", $businessRoleResource);
        $this->assertStringContainsString("'guard_name' => 'web'", $businessRoleResource);
        $this->assertStringContainsString("'gym_id' => null", $businessRoleResource);
        $this->assertStringContainsString('BusinessRoleResource::sanitizeRolePersistenceData($data)', $createBusinessRole);
        $this->assertStringContainsString('BusinessRoleResource::sanitizeRolePersistenceData($data)', $editBusinessRole);
        $this->assertStringContainsString('protected array $capturedPermissionNames = []', $createBusinessRole);
        $this->assertStringContainsString('protected array $capturedPermissionNames = []', $editBusinessRole);
        $this->assertStringContainsString('$this->capturedPermissionNames = BusinessRoleResource::extractPermissionNamesFromFormState($data)', $createBusinessRole);
        $this->assertStringContainsString('$this->capturedPermissionNames = BusinessRoleResource::extractPermissionNamesFromFormState($data)', $editBusinessRole);
        $this->assertStringContainsString('resolvePermissionNames', $createBusinessRole);
        $this->assertStringContainsString('resolvePermissionNames', $editBusinessRole);
        $this->assertStringContainsString('permissionStateFallbackSources', $createBusinessRole);
        $this->assertStringContainsString('permissionStateFallbackSources', $editBusinessRole);
        $this->assertStringContainsString('BusinessRoleResource::extractPermissionNamesFromStateSources', $createBusinessRole);
        $this->assertStringContainsString('BusinessRoleResource::extractPermissionNamesFromStateSources', $editBusinessRole);
        $this->assertStringContainsString('primary_style', $testRunner);
        $this->assertStringContainsString('test_business_role_permission_extraction_rejects_non_permission_strings', $businessRoleTests);
        $this->assertStringContainsString('test_system_business_role_create_page_can_create_role_with_permission_selection', $businessRoleTests);
        $this->assertStringContainsString('test_business_role_edit_filters_shield_permission_state_before_database_update', $businessRoleTests);

        $strictCrudTests = $this->fileContents('tests/Feature/StrictFilamentCrudUiTest.php');
        $strictRoleTests = $this->fileContents('tests/Feature/StrictRoleAccessTest.php');
        $strictTenantTests = $this->fileContents('tests/Feature/StrictTenantIsolationEdgeTest.php');
        $strictSecurityTests = $this->fileContents('tests/Security/StrictSecurityPayloadTest.php');

        $this->assertStringContainsString('test_member_backend_create_edit_and_list_contract_is_strict', $strictCrudTests);
        $this->assertStringContainsString('test_business_role_livewire_ui_create_syncs_valid_permissions', $strictCrudTests);
        $this->assertStringContainsString('test_business_user_without_required_permission_is_forbidden_from_member_index', $strictRoleTests);
        $this->assertStringContainsString('test_system_admin_and_business_user_tables_remain_separate', $strictRoleTests);
        $this->assertStringContainsString('test_member_queries_only_show_active_gym_records_for_business_user', $strictTenantTests);
        $this->assertStringContainsString('test_business_user_cannot_access_unassigned_gym_tenant', $strictTenantTests);
        $this->assertStringContainsString('test_invalid_member_payload_rejects_xss_email_and_invalid_source', $strictSecurityTests);
        $this->assertStringContainsString('test_negative_expense_amount_is_rejected', $strictSecurityTests);
        $this->assertStringContainsString('validShieldRoleFormState', $businessRoleTests);
        $this->assertStringContainsString('tests/Unit tests/Feature tests/Regression tests/Security', $testRunner);

        $this->logPass(__FUNCTION__);
    }
}
