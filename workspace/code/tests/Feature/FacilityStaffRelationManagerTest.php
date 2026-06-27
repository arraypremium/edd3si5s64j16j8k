<?php

use App\Models\Gym;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

uses(RefreshDatabase::class);

// Set Spatie Teams team ID before each test (gym_id cannot be null)
beforeEach(function () {
    $gym = Gym::firstOrCreate(['name' => 'Test Central Gym']);
    app(PermissionRegistrar::class)->setPermissionsTeamId($gym->id);
    setPermissionsTeamId($gym->id);
});

it('shows only facility staff for current gym via facilityStaff relationship', function () {
    Role::firstOrCreate(['name' => 'super_admin', 'guard_name' => 'web', 'gym_id' => null]);

    $gymA = Gym::create(['name' => 'Gym A Unique', 'slug' => 'gym-a-unique', 'status' => 'active']);
    $gymB = Gym::create(['name' => 'Gym B Unique', 'slug' => 'gym-b-unique', 'status' => 'active']);

    $userA = User::create([
        'name' => 'User A',
        'username' => 'user_a_test',
        'password' => Hash::make('p'),
    ]);
    $userB = User::create([
        'name' => 'User B',
        'username' => 'user_b_test',
        'password' => Hash::make('p'),
    ]);
    $superAdmin = User::create([
        'name' => 'Super',
        'username' => 'super_test_user',
        'password' => Hash::make('p'),
    ]);
    $superAdmin->assignRole('super_admin');

    // Attach users to gyms
    $gymA->users()->attach($userA->id, ['role' => 'owner']);
    $gymB->users()->attach($userB->id, ['role' => 'owner']);
    // Even if accidentally attached, super_admin MUST be excluded
    $gymA->users()->attach($superAdmin->id, ['role' => 'staff']);

    // Refresh the gymA relationship cache
    $gymA->unsetRelation('users');
    $gymA->unsetRelation('facilityStaff');

    // Assert: gym A's facilityStaff returns ONLY userA (not userB, not super_admin)
    $gymAStaffIds = $gymA->facilityStaff()->pluck('users.id')->toArray();

    expect($gymAStaffIds)->toContain($userA->id);
    expect($gymAStaffIds)->not->toContain($userB->id);
    expect($gymAStaffIds)->not->toContain($superAdmin->id);
});

it('facilityStaff excludes users with username admin', function () {
    $gym = Gym::create(['name' => 'Test Gym Admin User', 'slug' => 'test-gym-admin', 'status' => 'active']);

    $admin = User::create([
        'name' => 'Admin',
        'username' => 'admin',
        'password' => Hash::make('p'),
    ]);
    $gym->users()->attach($admin->id, ['role' => 'owner']);

    expect($gym->facilityStaff()->pluck('users.id')->toArray())
        ->not->toContain($admin->id);
});

it('facilityUsers scope excludes usernames colliding with system_admins', function () {
    // NOTE: system_admins has no email column. Collision check uses username.
    \App\Models\SystemAdmin::firstOrCreate(
        ['username' => 'collision_test_user'],
        [
            'name' => 'System Admin',
            'password' => Hash::make('p'),
            'status' => 'active',
        ]
    );

    $userWithSameUsername = User::create([
        'name' => 'User With Same Username',
        'password' => Hash::make('p'),
        'username' => 'collision_test_user',
    ]);

    expect(User::facilityUsers()->pluck('id')->toArray())
        ->not->toContain($userWithSameUsername->id);
});
