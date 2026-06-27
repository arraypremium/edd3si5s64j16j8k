<?php

namespace Tests\Feature;

use App\Filament\Resources\BusinessRoleResource;
use App\Filament\Resources\BusinessRoleResource\Pages\CreateBusinessRole;
use App\Filament\Resources\BusinessRoleResource\Pages\EditBusinessRole;
use App\Filament\Resources\Enquiries\EnquiryResource;
use App\Filament\Resources\Expenses\ExpenseResource;
use App\Models\SystemAdmin;
use Filament\Facades\Filament;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Livewire\Livewire;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;
use Tests\BaseGymieTest;

class BusinessRoleResourceTest extends BaseGymieTest
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        if (function_exists('setPermissionsTeamId')) {
            setPermissionsTeamId(null);
        }

        app(PermissionRegistrar::class)->setPermissionsTeamId(null);
        app(PermissionRegistrar::class)->forgetCachedPermissions();
    }

    public function test_business_role_create_filters_shield_permission_state_before_database_insert(): void
    {
        $unsafeState = $this->unsafeShieldRoleFormState([
            'name' => 'limited access',
            'guard_name' => 'api',
            'gym_id' => 999,
            'unexpected_column' => 'must never be persisted',
        ]);

        $safeData = BusinessRoleResource::sanitizeRolePersistenceData($unsafeState);

        $this->assertSame([
            'name' => 'limited access',
            'guard_name' => 'web',
            'gym_id' => null,
        ], $safeData);
        $this->assertArrayNotHasKey(EnquiryResource::class, $safeData);
        $this->assertArrayNotHasKey(ExpenseResource::class, $safeData);
        $this->assertArrayNotHasKey('pages_tab', $safeData);
        $this->assertArrayNotHasKey('widgets_tab', $safeData);
        $this->assertArrayNotHasKey('unexpected_column', $safeData);

        $role = Role::create($safeData);

        $this->assertDatabaseHas('roles', [
            'id' => $role->id,
            'name' => 'limited access',
            'guard_name' => 'web',
            'gym_id' => null,
        ]);
        $this->assertFalse(\Illuminate\Support\Facades\Schema::hasColumn('roles', EnquiryResource::class));
        $this->logPass(__FUNCTION__);
    }

    public function test_business_role_permission_extraction_rejects_non_permission_strings(): void
    {
        $permissionNames = BusinessRoleResource::extractPermissionNamesFromFormState($this->unsafeShieldRoleFormState([
            'unexpected_column' => 'must never be persisted',
            'malformed_permission' => 'Not A Permission Name',
        ]));

        $this->assertContains('ViewAny:Enquiry', $permissionNames);
        $this->assertContains('Create:Enquiry', $permissionNames);
        $this->assertContains('Dashboard:Access', $permissionNames);
        $this->assertNotContains('must never be persisted', $permissionNames);
        $this->assertNotContains('Not A Permission Name', $permissionNames);
        $this->logPass(__FUNCTION__);
    }

    public function test_system_business_role_create_page_can_create_role_with_permission_selection(): void
    {
        $this->actingAsSystemAdmin();

        $formState = $this->validShieldRoleFormState([
            'name' => 'front desk limited',
            'guard_name' => 'api',
            'gym_id' => 777,
        ]);

        Livewire::test(CreateBusinessRole::class)
            ->fillForm($formState)
            ->set('data', $formState)
            ->call('create')
            ->assertHasNoFormErrors();

        $role = Role::query()
            ->where('name', 'front desk limited')
            ->where('guard_name', 'web')
            ->whereNull('gym_id')
            ->firstOrFail();

        $this->assertDatabaseHas('permissions', ['name' => 'ViewAny:Enquiry', 'guard_name' => 'web']);
        $this->assertDatabaseHas('permissions', ['name' => 'Create:Enquiry', 'guard_name' => 'web']);
        $this->assertDatabaseHas('permissions', ['name' => 'ViewAny:Expense', 'guard_name' => 'web']);
        $this->assertTrue($role->hasPermissionTo('ViewAny:Enquiry'));
        $this->assertTrue($role->hasPermissionTo('Create:Enquiry'));
        $this->assertTrue($role->hasPermissionTo('ViewAny:Expense'));
        $this->logPass(__FUNCTION__);
    }

    public function test_business_role_edit_filters_shield_permission_state_before_database_update(): void
    {
        $this->actingAsSystemAdmin();

        $role = Role::create([
            'name' => 'editable role',
            'guard_name' => 'web',
            'gym_id' => null,
        ]);

        Permission::firstOrCreate(['name' => 'ViewAny:Enquiry', 'guard_name' => 'web']);
        Permission::firstOrCreate(['name' => 'ViewAny:Expense', 'guard_name' => 'web']);

        $formState = $this->validShieldRoleFormState([
            'name' => 'edited limited role',
            'guard_name' => 'api',
            'gym_id' => 888,
        ]);

        Livewire::test(EditBusinessRole::class, ['record' => $role->getRouteKey()])
            ->fillForm($formState)
            ->set('data', $formState)
            ->call('save')
            ->assertHasNoFormErrors();

        $role->refresh();

        $this->assertSame('edited limited role', $role->name);
        $this->assertSame('web', $role->guard_name);
        $this->assertNull($role->gym_id);
        $this->assertDatabaseHas('permissions', ['name' => 'ViewAny:Enquiry', 'guard_name' => 'web']);
        $this->assertDatabaseHas('permissions', ['name' => 'ViewAny:Expense', 'guard_name' => 'web']);
        $this->assertTrue($role->hasPermissionTo('ViewAny:Enquiry'));
        $this->assertTrue($role->hasPermissionTo('ViewAny:Expense'));
        $this->logPass(__FUNCTION__);
    }

    public function test_business_role_create_forces_web_guard_and_global_gym_scope(): void
    {
        $safeData = BusinessRoleResource::sanitizeRolePersistenceData([
            'name' => 'forced global role',
            'guard_name' => 'system_admin',
            'gym_id' => 12345,
        ]);

        $role = Role::create($safeData);

        $this->assertSame('forced global role', $role->name);
        $this->assertSame('web', $role->guard_name);
        $this->assertNull($role->gym_id);
        $this->logPass(__FUNCTION__);
    }

    public function test_business_role_duplicate_name_validation_remains_scoped_to_web_global_roles(): void
    {
        $this->actingAsSystemAdmin();

        Role::create([
            'name' => 'duplicate limited role',
            'guard_name' => 'web',
            'gym_id' => null,
        ]);

        Livewire::test(CreateBusinessRole::class)
            ->fillForm([
                'name' => 'duplicate limited role',
                'guard_name' => 'web',
            ])
            ->call('create')
            ->assertHasFormErrors(['name']);

        $this->assertSame(1, Role::query()
            ->where('name', 'duplicate limited role')
            ->where('guard_name', 'web')
            ->whereNull('gym_id')
            ->count());
        $this->logPass(__FUNCTION__);
    }

    /**
     * @param  array<string, mixed>  $overrides
     * @return array<string, mixed>
     */
    private function unsafeShieldRoleFormState(array $overrides = []): array
    {
        return array_merge([
            'name' => 'strict limited role',
            'guard_name' => 'web',
            EnquiryResource::class => [
                'ViewAny:Enquiry',
                'Create:Enquiry',
            ],
            ExpenseResource::class => [
                'ViewAny:Expense',
            ],
            'pages_tab' => ['Dashboard:Access'],
            'widgets_tab' => ['Dashboard:MembershipKpiCards'],
            'select_all' => false,
        ], $overrides);
    }

    /**
     * @param  array<string, mixed>  $overrides
     * @return array<string, mixed>
     */
    private function validShieldRoleFormState(array $overrides = []): array
    {
        $state = $this->unsafeShieldRoleFormState($overrides);

        unset($state['pages_tab'], $state['widgets_tab']);

        return $state;
    }

    private function actingAsSystemAdmin(): SystemAdmin
    {
        Filament::setCurrentPanel(Filament::getPanel('system'));

        $admin = SystemAdmin::create([
            'name' => 'Strict Test System Admin',
            'username' => 'strict_system_admin',
            'password' => Hash::make('password'),
            'status' => 'active',
        ]);

        $this->actingAs($admin, 'system_admin');

        return $admin;
    }
}
