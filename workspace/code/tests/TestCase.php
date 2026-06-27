<?php

namespace Tests;

use App\Models\Gym;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\PermissionRegistrar;

abstract class TestCase extends BaseTestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->bootstrapDefaultGymTenant();
    }

    private function bootstrapDefaultGymTenant(): void
    {
        if (! Schema::hasTable('gyms')) {
            return;
        }

        $this->sanitizeSeededGymsForTests();

        $gymId = DB::table('gyms')->where('name', 'Central Gym')->value('id');

        if (! $gymId) {
            $now = now();
            $data = [
                'name' => 'Central Gym',
                'address' => 'Test Address',
                'assigned_id' => 'TST001',
                'status' => 'active',
                'created_at' => $now,
                'updated_at' => $now,
            ];

            if (Schema::hasColumn('gyms', 'owner_name')) {
                $data['owner_name'] = 'Test Owner';
            }

            if (Schema::hasColumn('gyms', 'owner_number')) {
                $data['owner_number'] = '+10000000000';
            }

            if (Schema::hasColumn('gyms', 'owner_email')) {
                $data['owner_email'] = 'owner@example.com';
            }

            if (Schema::hasColumn('gyms', 'description')) {
                $data['description'] = 'Default gym created for automated tests.';
            }

            if (Schema::hasColumn('gyms', 'business_name')) {
                $data['business_name'] = 'Central Gym';
            }

            if (Schema::hasColumn('gyms', 'business_number')) {
                $data['business_number'] = 'TST-BIZ-001';
            }

            if (Schema::hasColumn('gyms', 'business_address')) {
                $data['business_address'] = 'Test Address';
            }

            if (Schema::hasColumn('gyms', 'subscription_status')) {
                $data['subscription_status'] = 'none';
            }

            $gymId = DB::table('gyms')->insertGetId($data);
        }

        $gymId = (int) $gymId;
        session(['active_gym_id' => $gymId]);
        Gym::query()->whereKey($gymId)->first();

        if (function_exists('setPermissionsTeamId')) {
            setPermissionsTeamId($gymId);
        }

        if (class_exists(PermissionRegistrar::class)) {
            app(PermissionRegistrar::class)->setPermissionsTeamId($gymId);
            app(PermissionRegistrar::class)->forgetCachedPermissions();
        }

        $this->syncBelongsToGymStaticCaches($gymId);
    }

    private function sanitizeSeededGymsForTests(): void
    {
        if (! Schema::hasTable('gyms')) {
            return;
        }

        $updates = [];

        if (Schema::hasColumn('gyms', 'expiry_date')) {
            $updates['expiry_date'] = null;
        }

        if (Schema::hasColumn('gyms', 'subscription_status')) {
            $updates['subscription_status'] = 'none';
        }

        if ($updates === []) {
            return;
        }

        $updates['updated_at'] = now();

        DB::table('gyms')->update($updates);
    }

    private function syncBelongsToGymStaticCaches(int $gymId): void
    {
        $classes = [
            \App\Models\Enquiry::class,
            \App\Models\Expense::class,
            \App\Models\FollowUp::class,
            \App\Models\Invoice::class,
            \App\Models\InvoiceTransaction::class,
            \App\Models\Member::class,
            \App\Models\Plan::class,
            \App\Models\Service::class,
            \App\Models\Subscription::class,
        ];

        foreach ($classes as $class) {
            if (! class_exists($class)) {
                continue;
            }

            $reflection = new \ReflectionClass($class);

            if (! $reflection->hasProperty('staticCachedCentralGymId')) {
                continue;
            }

            $property = $reflection->getProperty('staticCachedCentralGymId');
            $property->setAccessible(true);
            $property->setValue(null, $gymId);
        }
    }
}
