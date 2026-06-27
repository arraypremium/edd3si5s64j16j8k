<?php

use App\Models\Gym;
use App\Models\SystemAdmin;
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

it('excludes system admins from facility users list', function () {
    // Arrange
    Role::firstOrCreate(
        ['name' => 'super_admin', 'guard_name' => 'web', 'gym_id' => null]
    );

    SystemAdmin::firstOrCreate(
        ['username' => 'test_admin_1'],
        [
            'name' => 'Test Admin',
            'password' => Hash::make('password'),
            'status' => 'active',
        ]
    );

    User::create([
        'name' => 'User 1',
        'username' => 'facility_user_1',
        'password' => Hash::make('p'),
    ]);

    User::create([
        'name' => 'User 2',
        'username' => 'facility_user_2',
        'password' => Hash::make('p'),
    ]);

    // Act
    $facilityUsernames = User::facilityUsers()
        ->whereIn('username', ['facility_user_1', 'facility_user_2', 'test_admin_1'])
        ->pluck('username')
        ->toArray();

    // Assert
    expect($facilityUsernames)
        ->toHaveCount(2)
        ->not->toContain('test_admin_1')
        ->toContain('facility_user_1')
        ->toContain('facility_user_2');
});

it('excludes user with colliding username from facility users list', function () {
    // NOTE: system_admins has no email column. Collision check uses username.
    SystemAdmin::firstOrCreate(
        ['username' => 'collision_username'],
        [
            'name' => 'Admin Dup',
            'password' => Hash::make('password'),
            'status' => 'active',
        ]
    );

    User::create([
        'name' => 'User With Same Username',
        'username' => 'collision_username',
        'password' => Hash::make('p'),
    ]);

    // Act
    $facilityUsers = User::facilityUsers()->get();

    // Assert: user with colliding username must be excluded
    expect($facilityUsers->pluck('username')->toArray())
        ->not->toContain('collision_username');
});

it('excludes user holding super_admin Spatie role', function () {
    // Arrange
    Role::firstOrCreate(
        ['name' => 'super_admin', 'guard_name' => 'web', 'gym_id' => null]
    );

    $superAdmin = User::create([
        'name' => 'Super Admin User',
        'username' => 'super_admin_user',
        'password' => Hash::make('p'),
    ]);
    $superAdmin->assignRole('super_admin');

    User::create([
        'name' => 'Regular User',
        'username' => 'regular_user',
        'password' => Hash::make('p'),
    ]);

    // Act
    $facilityUsers = User::facilityUsers()->get();

    // Assert
    expect($facilityUsers->pluck('username')->toArray())
        ->not->toContain('super_admin_user')
        ->toContain('regular_user');
});
