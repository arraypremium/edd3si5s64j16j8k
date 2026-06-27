<?php

use App\Models\Gym;
use App\Models\SystemAdmin;
use App\Models\User;
use App\Notifications\ExpiringGymSubscriptionNotification;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;

it('sends notification for gym expiring within 10 days', function () {
    Notification::fake();

    $gym = Gym::create([
        'name' => 'Test Gym',
        'slug' => 'test-gym',
        'status' => 'active',
        'subscription_status' => 'active',
        'expiry_date' => now()->addDays(5)->toDateString(),
    ]);

    $admin = SystemAdmin::create([
        'name' => 'Admin',
        'username' => 'admin_test',
        'email' => 'admin@test.com',
        'password' => Hash::make('p'),
        'status' => 'active',
    ]);

    $owner = User::create([
        'name' => 'Owner',
        'email' => 'o@test.com',
        'password' => Hash::make('p'),
        'username' => 'owner',
    ]);
    $gym->users()->attach($owner->id, ['role' => 'owner']);

    $this->artisan('gymie:notify-expiring-gym-subscriptions', ['--days' => 10])
        ->expectsOutputToContain('Test Gym')
        ->assertSuccessful();

    Notification::assertSentTo($admin, ExpiringGymSubscriptionNotification::class);
    Notification::assertSentTo($owner, ExpiringGymSubscriptionNotification::class);
});

it('does NOT send notification for gym expiring beyond 10 days', function () {
    Notification::fake();

    $gym = Gym::create([
        'name' => 'Far Future Gym',
        'slug' => 'far-future',
        'status' => 'active',
        'subscription_status' => 'active',
        'expiry_date' => now()->addDays(20)->toDateString(),
    ]);

    $admin = SystemAdmin::create([
        'name' => 'Admin',
        'username' => 'admin_test2',
        'email' => 'admin2@test.com',
        'password' => Hash::make('p'),
        'status' => 'active',
    ]);

    $this->artisan('gymie:notify-expiring-gym-subscriptions', ['--days' => 10])
        ->expectsOutputToContain('No business subscriptions expiring within 10 days')
        ->assertSuccessful();

    Notification::assertNotSentTo($admin, ExpiringGymSubscriptionNotification::class);
});

it('does NOT send notification for suspended gym', function () {
    Notification::fake();

    $gym = Gym::create([
        'name' => 'Suspended Gym',
        'slug' => 'suspended',
        'status' => 'suspended',  // suspended — must be excluded
        'subscription_status' => 'active',
        'expiry_date' => now()->addDays(5)->toDateString(),
    ]);

    $admin = SystemAdmin::create([
        'name' => 'Admin',
        'username' => 'admin_test3',
        'email' => 'admin3@test.com',
        'password' => Hash::make('p'),
        'status' => 'active',
    ]);

    $this->artisan('gymie:notify-expiring-gym-subscriptions', ['--days' => 10])
        ->expectsOutputToContain('No business')
        ->assertSuccessful();

    Notification::assertNotSentTo($admin, ExpiringGymSubscriptionNotification::class);
});

it('does NOT send notification for already-expired gym', function () {
    Notification::fake();

    $gym = Gym::create([
        'name' => 'Expired Gym',
        'slug' => 'expired',
        'status' => 'active',
        'subscription_status' => 'expired',  // already expired
        'expiry_date' => now()->subDays(2)->toDateString(),
    ]);

    $admin = SystemAdmin::create([
        'name' => 'Admin',
        'username' => 'admin_test4',
        'email' => 'admin4@test.com',
        'password' => Hash::make('p'),
        'status' => 'active',
    ]);

    $this->artisan('gymie:notify-expiring-gym-subscriptions', ['--days' => 10])
        ->assertSuccessful();

    Notification::assertNotSentTo($admin, ExpiringGymSubscriptionNotification::class);
});

it('rejects invalid --days option', function () {
    $this->artisan('gymie:notify-expiring-gym-subscriptions', ['--days' => 0])
        ->expectsOutputToContain('--days must be >= 1')
        ->assertFailed();
});
