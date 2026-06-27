<?php

namespace Tests\Feature;

use App\Models\SystemAdmin;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\Sanctum;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;
use Tests\BaseGymieTest;

class StrictRoleAccessTest extends BaseGymieTest
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        app(PermissionRegistrar::class)->forgetCachedPermissions();
    }

    public function test_business_user_without_required_permission_is_forbidden_from_member_index(): void
    {
        $user = User::factory()->create();

        Sanctum::actingAs($user);

        $this->getJson('/api/v1/members')->assertForbidden();
        $this->logPass(__FUNCTION__);
    }

    public function test_business_user_with_required_permission_can_access_member_index(): void
    {
        Permission::findOrCreate('ViewAny:Member', 'web');

        $user = User::factory()->create();
        $user->givePermissionTo('ViewAny:Member');

        Sanctum::actingAs($user);

        $this->getJson('/api/v1/members')->assertSuccessful();
        $this->logPass(__FUNCTION__);
    }

    public function test_create_permission_is_required_for_member_store(): void
    {
        Permission::findOrCreate('ViewAny:Member', 'web');

        $user = User::factory()->create();
        $user->givePermissionTo('ViewAny:Member');

        Sanctum::actingAs($user);

        $this->postJson('/api/v1/members', [
            'name' => 'Denied Store Member',
            'email' => 'denied-store-member@example.com',
            'contact' => '+91 9000000201',
            'gender' => 'male',
            'status' => 'active',
        ])->assertForbidden();

        $this->assertDatabaseMissing('members', ['email' => 'denied-store-member@example.com']);
        $this->logPass(__FUNCTION__);
    }

    public function test_system_admin_and_business_user_tables_remain_separate(): void
    {
        SystemAdmin::create([
            'name' => 'Strict System Admin',
            'username' => 'strict_access_admin',
            'password' => Hash::make('password'),
            'status' => 'active',
        ]);

        User::create([
            'name' => 'Colliding Business User',
            'username' => 'strict_access_admin',
            'password' => Hash::make('password'),
            'status' => 'active',
        ]);

        $facilityUsernames = User::facilityUsers()->pluck('username')->all();

        $this->assertNotContains('strict_access_admin', $facilityUsernames);
        $this->logPass(__FUNCTION__);
    }
}
