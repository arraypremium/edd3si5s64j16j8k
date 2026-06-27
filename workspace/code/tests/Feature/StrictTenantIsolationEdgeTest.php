<?php

namespace Tests\Feature;

use App\Models\Enquiry;
use App\Models\Gym;
use App\Models\Member;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\PermissionRegistrar;
use Tests\BaseGymieTest;

class StrictTenantIsolationEdgeTest extends BaseGymieTest
{
    use RefreshDatabase;

    public function test_member_queries_only_show_active_gym_records_for_business_user(): void
    {
        [$gymA, $gymB, $user] = $this->makeTwoGymContext();

        $memberA = Member::withoutEvents(fn () => Member::withoutGlobalScopes()->create([
            'gym_id' => $gymA->id,
            'code' => 'M-A01',
            'name' => 'Gym A Member',
            'email' => 'gym-a-member@example.com',
            'contact' => '+91 9000000301',
            'gender' => 'male',
            'status' => 'active',
        ]));

        $memberB = Member::withoutEvents(fn () => Member::withoutGlobalScopes()->create([
            'gym_id' => $gymB->id,
            'code' => 'M-B01',
            'name' => 'Gym B Member',
            'email' => 'gym-b-member@example.com',
            'contact' => '+91 9000000302',
            'gender' => 'female',
            'status' => 'active',
        ]));

        $this->actingAs($user);
        session(['active_gym_id' => $gymB->id]);
        app(PermissionRegistrar::class)->setPermissionsTeamId($gymB->id);

        $visibleIds = Member::query()->pluck('id')->all();

        $this->assertContains($memberB->id, $visibleIds);
        $this->assertNotContains($memberA->id, $visibleIds);
        $this->logPass(__FUNCTION__);
    }

    public function test_enquiry_queries_only_show_active_gym_records_for_business_user(): void
    {
        [$gymA, $gymB, $user] = $this->makeTwoGymContext();

        $enquiryA = Enquiry::withoutGlobalScopes()->create([
            'gym_id' => $gymA->id,
            'name' => 'Gym A Lead',
            'email' => 'gym-a-lead@example.com',
            'contact' => '+91 9000000303',
            'gender' => 'male',
            'date' => '2026-06-26',
            'status' => 'lead',
            'source' => 'website',
        ]);

        $enquiryB = Enquiry::withoutGlobalScopes()->create([
            'gym_id' => $gymB->id,
            'name' => 'Gym B Lead',
            'email' => 'gym-b-lead@example.com',
            'contact' => '+91 9000000304',
            'gender' => 'female',
            'date' => '2026-06-26',
            'status' => 'lead',
            'source' => 'instagram',
        ]);

        $this->actingAs($user);
        session(['active_gym_id' => $gymB->id]);
        app(PermissionRegistrar::class)->setPermissionsTeamId($gymB->id);

        $visibleIds = Enquiry::query()->pluck('id')->all();

        $this->assertContains($enquiryB->id, $visibleIds);
        $this->assertNotContains($enquiryA->id, $visibleIds);
        $this->logPass(__FUNCTION__);
    }

    public function test_business_user_cannot_access_unassigned_gym_tenant(): void
    {
        [$gymA, $gymB, $user] = $this->makeTwoGymContext();

        $this->assertTrue($user->canAccessTenant($gymB));
        $this->assertFalse($user->canAccessTenant($gymA));
        $this->logPass(__FUNCTION__);
    }

    /**
     * @return array{0: Gym, 1: Gym, 2: User}
     */
    private function makeTwoGymContext(): array
    {
        $gymA = Gym::create([
            'name' => 'Strict Gym A',
            'assigned_id' => 'SGA001',
            'status' => 'active',
        ]);

        $gymB = Gym::create([
            'name' => 'Strict Gym B',
            'assigned_id' => 'SGB001',
            'status' => 'active',
        ]);

        $user = User::create([
            'name' => 'Strict Tenant User',
            'username' => 'strict_tenant_user',
            'password' => Hash::make('password'),
            'status' => 'active',
        ]);

        $user->gyms()->attach($gymB->id, ['role' => 'owner']);
        $user->load('gyms');

        return [$gymA, $gymB, $user];
    }
}
