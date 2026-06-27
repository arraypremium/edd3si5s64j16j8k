<?php

namespace Tests\Feature;

use App\Filament\Resources\BusinessRoleResource;
use App\Filament\Resources\BusinessRoleResource\Pages\CreateBusinessRole;
use App\Filament\Resources\BusinessRoleResource\Pages\EditBusinessRole;
use App\Filament\Resources\Enquiries\EnquiryResource;
use App\Filament\Resources\Members\MemberResource;
use App\Models\Enquiry;
use App\Models\Member;
use App\Models\SystemAdmin;
use Filament\Facades\Filament;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Livewire\Livewire;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;
use Tests\BaseGymieTest;

class StrictFilamentCrudUiTest extends BaseGymieTest
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

    public function test_member_resource_exposes_create_edit_and_list_ui_pages(): void
    {
        $pages = MemberResource::getPages();

        $this->assertArrayHasKey('index', $pages);
        $this->assertArrayHasKey('create', $pages);
        $this->assertArrayHasKey('edit', $pages);
        $resource = $this->fileContents('app/Filament/Resources/Members/MemberResource.php');
        $this->assertStringContainsString('CreateMember::route', $resource);
        $this->assertStringContainsString('EditMember::route', $resource);
        $this->assertStringContainsString('ListMembers::route', $resource);
        $this->logPass(__FUNCTION__);
    }

    public function test_member_backend_create_edit_and_list_contract_is_strict(): void
    {
        $member = Member::create([
            'name' => 'Strict UI Member',
            'email' => 'strict-ui-member@example.com',
            'contact' => '+91 9000000101',
            'gender' => 'male',
            'source' => 'website',
            'status' => 'active',
        ]);

        $this->assertDatabaseHas('members', [
            'id' => $member->id,
            'name' => 'Strict UI Member',
            'email' => 'strict-ui-member@example.com',
        ]);

        $member->update([
            'name' => 'Strict UI Member Updated',
            'source' => 'referral',
            'status' => 'inactive',
        ]);

        $this->assertDatabaseHas('members', [
            'id' => $member->id,
            'name' => 'Strict UI Member Updated',
            'source' => 'referral',
            'status' => 'inactive',
        ]);

        $this->assertTrue(Member::query()->whereKey($member->id)->exists());
        $this->logPass(__FUNCTION__);
    }

    public function test_enquiry_resource_exposes_create_edit_and_list_ui_pages(): void
    {
        $pages = EnquiryResource::getPages();

        $this->assertArrayHasKey('index', $pages);
        $this->assertArrayHasKey('create', $pages);
        $this->assertArrayHasKey('edit', $pages);
        $resource = $this->fileContents('app/Filament/Resources/Enquiries/EnquiryResource.php');
        $this->assertStringContainsString('CreateEnquiry::route', $resource);
        $this->assertStringContainsString('EditEnquiry::route', $resource);
        $this->assertStringContainsString('ListEnquiries::route', $resource);
        $this->logPass(__FUNCTION__);
    }

    public function test_enquiry_backend_create_edit_and_list_contract_is_strict(): void
    {
        $enquiry = Enquiry::create([
            'name' => 'Strict UI Lead',
            'email' => 'strict-ui-lead@example.com',
            'contact' => '+91 9000000102',
            'gender' => 'female',
            'date' => '2026-06-26',
            'source' => 'instagram',
            'status' => 'lead',
        ]);

        $this->assertDatabaseHas('enquiries', [
            'id' => $enquiry->id,
            'name' => 'Strict UI Lead',
            'email' => 'strict-ui-lead@example.com',
        ]);

        $enquiry->update([
            'name' => 'Strict UI Lead Updated',
            'source' => 'referral',
            'status' => 'lost',
        ]);

        $this->assertDatabaseHas('enquiries', [
            'id' => $enquiry->id,
            'name' => 'Strict UI Lead Updated',
            'source' => 'referral',
            'status' => 'lost',
        ]);

        $this->assertTrue(Enquiry::query()->whereKey($enquiry->id)->exists());
        $this->logPass(__FUNCTION__);
    }

    public function test_business_role_livewire_ui_create_syncs_valid_permissions(): void
    {
        $this->actingAsSystemAdmin();

        $formState = [
            'name' => 'strict ui access',
            'guard_name' => 'web',
            \App\Filament\Resources\Enquiries\EnquiryResource::class => [
                'ViewAny:Enquiry',
                'Create:Enquiry',
            ],
            \App\Filament\Resources\Expenses\ExpenseResource::class => [
                'ViewAny:Expense',
            ],
            'select_all' => false,
        ];

        Livewire::test(CreateBusinessRole::class)
            ->fillForm($formState)
            ->set('data', $formState)
            ->call('create')
            ->assertHasNoFormErrors();

        $role = Role::query()
            ->where('name', 'strict ui access')
            ->where('guard_name', 'web')
            ->whereNull('gym_id')
            ->firstOrFail();

        $this->assertTrue($role->hasPermissionTo('ViewAny:Enquiry'));
        $this->assertTrue($role->hasPermissionTo('Create:Enquiry'));
        $this->assertTrue($role->hasPermissionTo('ViewAny:Expense'));
        $this->logPass(__FUNCTION__);
    }

    public function test_business_role_livewire_ui_edit_syncs_valid_permissions(): void
    {
        $this->actingAsSystemAdmin();

        $role = Role::create([
            'name' => 'strict editable access',
            'guard_name' => 'web',
            'gym_id' => null,
        ]);

        $formState = [
            'name' => 'strict editable access updated',
            'guard_name' => 'web',
            \App\Filament\Resources\Enquiries\EnquiryResource::class => [
                'ViewAny:Enquiry',
            ],
            \App\Filament\Resources\Expenses\ExpenseResource::class => [
                'ViewAny:Expense',
            ],
            'select_all' => false,
        ];

        Livewire::test(EditBusinessRole::class, ['record' => $role->getRouteKey()])
            ->fillForm($formState)
            ->set('data', $formState)
            ->call('save')
            ->assertHasNoFormErrors();

        $role->refresh();

        $this->assertSame('strict editable access updated', $role->name);
        $this->assertTrue($role->hasPermissionTo('ViewAny:Enquiry'));
        $this->assertTrue($role->hasPermissionTo('ViewAny:Expense'));
        $this->logPass(__FUNCTION__);
    }

    private function actingAsSystemAdmin(): SystemAdmin
    {
        Filament::setCurrentPanel(Filament::getPanel('system'));

        $admin = SystemAdmin::create([
            'name' => 'Strict Feature Three System Admin',
            'username' => 'strict_feature_three_system_admin',
            'password' => Hash::make('password'),
            'status' => 'active',
        ]);

        $this->actingAs($admin, 'system_admin');

        return $admin;
    }
}
