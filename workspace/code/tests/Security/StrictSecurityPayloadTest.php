<?php

namespace Tests\Security;

use App\Models\Member;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;
use Tests\BaseGymieTest;

class StrictSecurityPayloadTest extends BaseGymieTest
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        app(PermissionRegistrar::class)->forgetCachedPermissions();
    }

    public function test_unauthorized_api_access_is_rejected_for_protected_resources(): void
    {
        $this->getJson('/api/v1/settings')->assertUnauthorized();
        $this->getJson('/api/v1/analytics/financial')->assertUnauthorized();
        $this->postJson('/api/v1/members', [])->assertUnauthorized();
        $this->logPass(__FUNCTION__);
    }

    public function test_invalid_member_payload_rejects_xss_email_and_invalid_source(): void
    {
        $user = $this->actingApiUserWithPermissions(['Create:Member']);

        Sanctum::actingAs($user);

        $this->postJson('/api/v1/members', [
            'name' => '<script>alert(1)</script>',
            'email' => '<script>alert(1)</script>',
            'contact' => '+91 9000000401',
            'gender' => 'male',
            'source' => 'not-a-real-source',
            'status' => 'active',
        ])->assertUnprocessable();

        $this->assertDatabaseMissing('members', ['name' => '<script>alert(1)</script>']);
        $this->logPass(__FUNCTION__);
    }

    public function test_sql_like_search_string_does_not_widen_member_results(): void
    {
        $user = $this->actingApiUserWithPermissions(['ViewAny:Member']);

        Member::create([
            'name' => 'Normal Strict Member',
            'email' => 'normal-strict-member@example.com',
            'contact' => '+91 9000000402',
            'gender' => 'male',
            'status' => 'active',
        ]);

        Sanctum::actingAs($user);

        $this->getJson('/api/v1/members?search=%27%20OR%201%3D1%20--')
            ->assertSuccessful()
            ->assertJsonCount(0, 'data');

        $this->logPass(__FUNCTION__);
    }

    public function test_negative_expense_amount_is_rejected(): void
    {
        $user = $this->actingApiUserWithPermissions(['Create:Expense']);

        Sanctum::actingAs($user);

        $this->postJson('/api/v1/expenses', [
            'name' => 'Negative Expense',
            'amount' => -1,
            'date' => '2026-06-26',
            'category' => 'rent',
            'status' => 'pending',
        ])->assertUnprocessable();

        $this->assertDatabaseMissing('expenses', ['name' => 'Negative Expense']);
        $this->logPass(__FUNCTION__);
    }

    /**
     * @param  list<string>  $permissions
     */
    private function actingApiUserWithPermissions(array $permissions): User
    {
        foreach ($permissions as $permission) {
            Permission::findOrCreate($permission, 'web');
        }

        $user = User::factory()->create();
        $user->givePermissionTo($permissions);

        return $user;
    }
}
