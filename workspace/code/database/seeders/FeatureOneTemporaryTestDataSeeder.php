<?php

namespace Database\Seeders;

use App\Models\Gym;
use App\Models\GymSubscription;
use App\Models\SystemAdmin;
use App\Models\SystemPlan;
use App\Models\User;
use App\Support\Dashboard\DashboardAccess;
use Carbon\CarbonImmutable;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class FeatureOneTemporaryTestDataSeeder extends Seeder
{
    private array $sources = [
        'word_of_mouth',
        'google_business_account',
        'website',
        'instagram',
        'facebook',
        'whatsapp',
        'justdial',
        'referral',
        'other',
    ];

    public function run(): void
    {
        DB::transaction(function (): void {
            $this->createSystemAdmin();
            $permissions = $this->createBusinessPermissions();
            $fullAccessRole = $this->createFullAccessBusinessRole($permissions);
            [$monthlyPlan, $yearlyPlan] = $this->createSystemPlans();
            [$businessOne, $businessTwo] = $this->createBusinesses($monthlyPlan, $yearlyPlan);
            [$userA, $userB, $userC] = $this->createBusinessUsers($businessOne, $businessTwo, $fullAccessRole);
            $this->createBusinessDashboardData($businessOne, $userA, 'B1');
            $this->createBusinessDashboardData($businessTwo, $userB, 'B2');
        });

        $this->command?->info('Feature 1 temporary test data imported successfully.');
        $this->command?->line('System admin: admin / Admin@12345');
        $this->command?->line('Business 1 user: a / a');
        $this->command?->line('Business 2 user: b / b');
        $this->command?->line('Shared user: c / c');
    }

    private function createSystemAdmin(): void
    {
        SystemAdmin::query()->updateOrCreate(
            ['username' => 'admin'],
            [
                'name' => 'System Admin',
                'password' => Hash::make('Admin@12345'),
                'status' => 'active',
            ]
        );

        if (Schema::hasTable('system_roles')) {
            $roleId = $this->upsertGetId('system_roles', ['name' => 'super_admin'], [
                'label' => 'Super Admin',
                'description' => 'Full system access for testing.',
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            if (Schema::hasTable('system_role_assignment')) {
                $adminId = (int) DB::table('system_admins')->where('username', 'admin')->value('id');
                DB::table('system_role_assignment')->updateOrInsert(
                    ['system_admin_id' => $adminId, 'system_role_id' => $roleId],
                    ['created_at' => now(), 'updated_at' => now()]
                );
            }
        }
    }

    private function createBusinessPermissions(): array
    {
        app(PermissionRegistrar::class)->forgetCachedPermissions();

        $resourceNames = [
            'BusinessRole', 'Dashboard', 'Enquiry', 'Expense', 'FollowUp', 'Gym', 'GymSubscription',
            'Invoice', 'Member', 'Plan', 'Service', 'Subscription', 'User',
        ];
        $actions = ['ViewAny', 'View', 'Create', 'Update', 'Delete', 'RestoreAny', 'ForceDeleteAny'];
        $permissionNames = [];

        foreach ($resourceNames as $resource) {
            foreach ($actions as $action) {
                $permissionNames[] = "{$action}:{$resource}";
            }
        }

        $permissionNames = array_values(array_unique(array_merge($permissionNames, array_keys(DashboardAccess::customPermissions()))));

        foreach ($permissionNames as $permissionName) {
            Permission::findOrCreate($permissionName, 'web');
        }

        return $permissionNames;
    }

    private function createFullAccessBusinessRole(array $permissionNames): Role
    {
        $role = Role::query()
            ->where('name', 'full_access')
            ->where('guard_name', 'web')
            ->whereNull('gym_id')
            ->first();

        if (! $role) {
            $role = Role::create([
                'name' => 'full_access',
                'guard_name' => 'web',
                'gym_id' => null,
            ]);
        }

        $role->syncPermissions($permissionNames);

        return $role;
    }

    private function createSystemPlans(): array
    {
        $monthly = SystemPlan::query()->updateOrCreate(
            ['code' => 'TEST-30-DAYS'],
            [
                'name' => 'Test 30 Days',
                'description' => 'Temporary 30-day system plan for testing.',
                'days' => 30,
                'amount' => 999,
                'status' => 'active',
            ]
        );

        $yearly = SystemPlan::query()->updateOrCreate(
            ['code' => 'TEST-1-YEAR'],
            [
                'name' => 'Test 1 Year',
                'description' => 'Temporary one-year system plan for testing.',
                'days' => 365,
                'amount' => 9999,
                'status' => 'active',
            ]
        );

        return [$monthly, $yearly];
    }

    private function createBusinesses(SystemPlan $monthlyPlan, SystemPlan $yearlyPlan): array
    {
        $businessOne = $this->upsertGym('Business One Gym', 'BIZ001', $monthlyPlan, 30);
        $businessTwo = $this->upsertGym('Business Two Gym', 'BIZ002', $yearlyPlan, 365);

        return [$businessOne, $businessTwo];
    }

    private function upsertGym(string $name, string $assignedId, SystemPlan $systemPlan, int $days): Gym
    {
        $gym = Gym::query()->updateOrCreate(
            ['name' => $name],
            [
                'assigned_id' => $assignedId,
                'status' => 'active',
                'address' => "{$name} Address",
                'owner_name' => "{$name} Owner",
                'owner_number' => '+910000000000',
                'owner_email' => strtolower(str_replace(' ', '.', $name)).'@example.com',
                'description' => "Temporary testing business {$name}.",
                'business_name' => $name,
                'business_number' => $assignedId,
                'business_address' => "{$name} Address",
                'expiry_date' => CarbonImmutable::today()->addDays($days)->toDateString(),
                'system_plan_id' => $systemPlan->id,
                'subscription_status' => 'active',
            ]
        );

        GymSubscription::query()->updateOrCreate(
            [
                'gym_id' => $gym->id,
                'system_plan_id' => $systemPlan->id,
                'start_date' => CarbonImmutable::today()->toDateString(),
            ],
            [
                'end_date' => CarbonImmutable::today()->addDays($days)->toDateString(),
                'status' => 'ongoing',
            ]
        );

        return $gym;
    }

    private function createBusinessUsers(Gym $businessOne, Gym $businessTwo, Role $fullAccessRole): array
    {
        $userA = $this->upsertUser('a', 'a', 'Business One User');
        $userB = $this->upsertUser('b', 'b', 'Business Two User');
        $userC = $this->upsertUser('c', 'c', 'Shared Business User');

        $this->attachUserToGym($userA, $businessOne, $fullAccessRole);
        $this->attachUserToGym($userB, $businessTwo, $fullAccessRole);
        $this->attachUserToGym($userC, $businessOne, $fullAccessRole);
        $this->attachUserToGym($userC, $businessTwo, $fullAccessRole);

        return [$userA, $userB, $userC];
    }

    private function upsertUser(string $username, string $password, string $name): User
    {
        return User::query()->updateOrCreate(
            ['username' => $username],
            [
                'name' => $name,
                'password' => Hash::make($password),
                'status' => 'active',
            ]
        );
    }

    private function attachUserToGym(User $user, Gym $gym, Role $role): void
    {
        $user->gyms()->syncWithoutDetaching([
            $gym->id => ['role' => $role->name],
        ]);

        if (function_exists('setPermissionsTeamId')) {
            setPermissionsTeamId($gym->id);
        }

        app(PermissionRegistrar::class)->setPermissionsTeamId($gym->id);
        $user->assignRole($role);
        $user->unsetRelation('roles');
        $user->unsetRelation('permissions');
    }

    private function createBusinessDashboardData(Gym $gym, User $owner, string $prefix): void
    {
        if (function_exists('setPermissionsTeamId')) {
            setPermissionsTeamId($gym->id);
        }
        app(PermissionRegistrar::class)->setPermissionsTeamId($gym->id);

        $serviceId = $this->upsertGetId('services', ['gym_id' => $gym->id, 'name' => "{$prefix} Fitness Service"], [
            'description' => 'Temporary service for dashboard testing.',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $planId = $this->upsertGetId('plans', ['gym_id' => $gym->id, 'code' => "{$prefix}-MONTHLY"], [
            'service_id' => $serviceId,
            'name' => "{$prefix} Monthly Plan",
            'description' => 'Temporary member plan for dashboard testing.',
            'days' => 30,
            'amount' => 1000,
            'status' => 'active',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        for ($i = 1; $i <= 50; $i++) {
            $memberId = $this->createMemberBundle($gym, $owner, $planId, $prefix, $i);

            if ($i <= 15) {
                $this->createEnquiryWithFollowUp($gym, $owner, $prefix, $i, $memberId);
            }
        }

        $this->createExpenses($gym, $prefix);
    }

    private function createMemberBundle(Gym $gym, User $owner, int $planId, string $prefix, int $i): int
    {
        $source = $this->sources[($i - 1) % count($this->sources)];
        $memberId = $this->upsertGetId('members', ['gym_id' => $gym->id, 'email' => strtolower("{$prefix}.member{$i}@example.com")], [
            'code' => sprintf('%s-MEM-%03d', $prefix, $i),
            'name' => sprintf('%s Member %03d', $prefix, $i),
            'contact' => '+91'.str_pad((string) (9000000000 + $i), 10, '0', STR_PAD_LEFT),
            'emergency_contact' => '+91'.str_pad((string) (8000000000 + $i), 10, '0', STR_PAD_LEFT),
            'gender' => $i % 3 === 0 ? 'other' : ($i % 2 === 0 ? 'female' : 'male'),
            'dob' => CarbonImmutable::today()->subYears(20 + ($i % 20))->toDateString(),
            'address' => "{$prefix} Member Address {$i}",
            'country' => 'India',
            'state' => 'Gujarat',
            'city' => 'Ahmedabad',
            'pincode' => '380001',
            'source' => $source,
            'status' => $i % 10 === 0 ? 'inactive' : 'active',
            'created_at' => CarbonImmutable::today()->subDays($i)->toDateTimeString(),
            'updated_at' => now(),
        ]);

        $start = CarbonImmutable::today()->subDays(($i % 25) + 5);
        $end = match (true) {
            $i % 10 === 0 => CarbonImmutable::today()->subDays($i % 5 + 1),
            $i % 7 === 0 => CarbonImmutable::today()->addDays(($i % 6) + 1),
            default => CarbonImmutable::today()->addDays(15 + ($i % 20)),
        };
        $status = $end->isPast() ? 'expired' : 'ongoing';

        $subscriptionId = $this->upsertGetId('subscriptions', ['gym_id' => $gym->id, 'member_id' => $memberId, 'plan_id' => $planId, 'start_date' => $start->toDateString()], [
            'end_date' => $end->toDateString(),
            'status' => $status,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $fee = 1000.00;
        $paid = match ($i % 4) {
            0 => 0.00,
            1 => 1000.00,
            2 => 500.00,
            default => 750.00,
        };
        $due = max($fee - $paid, 0);
        $invoiceStatus = $due <= 0 ? 'paid' : ($paid > 0 ? 'partial' : ($end->isPast() ? 'overdue' : 'issued'));

        $invoiceId = $this->upsertGetId('invoices', ['gym_id' => $gym->id, 'subscription_id' => $subscriptionId], [
            'number' => sprintf('%s-INV-%03d', $prefix, $i),
            'date' => $start->toDateString(),
            'due_date' => $start->addDays(7)->toDateString(),
            'payment_method' => $i % 2 === 0 ? 'cash' : 'online',
            'discount' => 0,
            'discount_amount' => 0,
            'discount_note' => null,
            'tax' => 0,
            'paid_amount' => $paid,
            'total_amount' => $fee,
            'due_amount' => $due,
            'subscription_fee' => $fee,
            'status' => $invoiceStatus,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        if ($paid > 0) {
            $this->upsertGetId('invoice_transactions', ['gym_id' => $gym->id, 'invoice_id' => $invoiceId, 'reference_id' => sprintf('%s-PAY-%03d', $prefix, $i)], [
                'type' => 'payment',
                'amount' => $paid,
                'occurred_at' => $start->addDays(1)->toDateTimeString(),
                'payment_method' => $i % 2 === 0 ? 'cash' : 'online',
                'note' => 'Temporary payment transaction.',
                'created_by' => $owner->id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        if ($i % 17 === 0) {
            $this->upsertGetId('invoice_transactions', ['gym_id' => $gym->id, 'invoice_id' => $invoiceId, 'reference_id' => sprintf('%s-REF-%03d', $prefix, $i)], [
                'type' => 'refund',
                'amount' => min($paid, 250),
                'occurred_at' => $start->addDays(2)->toDateTimeString(),
                'payment_method' => 'cash',
                'note' => 'Temporary refund transaction.',
                'created_by' => $owner->id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        return $memberId;
    }

    private function createEnquiryWithFollowUp(Gym $gym, User $owner, string $prefix, int $i, int $memberId): void
    {
        $status = $i % 5 === 0 ? 'lost' : ($i % 3 === 0 ? 'member' : 'lead');
        $enquiryId = $this->upsertGetId('enquiries', ['gym_id' => $gym->id, 'email' => strtolower("{$prefix}.lead{$i}@example.com")], [
            'user_id' => $owner->id,
            'name' => sprintf('%s Lead %03d', $prefix, $i),
            'contact' => '+91'.str_pad((string) (7000000000 + $i), 10, '0', STR_PAD_LEFT),
            'date' => CarbonImmutable::today()->subDays($i)->toDateString(),
            'gender' => $i % 2 === 0 ? 'female' : 'male',
            'dob' => CarbonImmutable::today()->subYears(25)->toDateString(),
            'address' => "{$prefix} Lead Address {$i}",
            'country' => 'India',
            'state' => 'Gujarat',
            'city' => 'Ahmedabad',
            'pincode' => '380001',
            'status' => $status,
            'interested_in' => json_encode(["{$prefix} Fitness Service"]),
            'source' => $this->sources[($i - 1) % count($this->sources)],
            'start_by' => CarbonImmutable::today()->addDays($i)->toDateString(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $this->upsertGetId('follow_ups', ['gym_id' => $gym->id, 'enquiry_id' => $enquiryId, 'schedule_date' => CarbonImmutable::today()->addDays($i)->toDateString()], [
            'user_id' => $owner->id,
            'method' => $i % 2 === 0 ? 'whatsapp' : 'call',
            'outcome' => $status === 'lost' ? 'Not interested' : 'Follow-up scheduled',
            'status' => $i % 4 === 0 ? 'done' : 'pending',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    private function createExpenses(Gym $gym, string $prefix): void
    {
        $categories = ['rent', 'utilities', 'supplies', 'maintenance', 'marketing', 'equipment', 'payroll', 'travel', 'other'];

        foreach ($categories as $index => $category) {
            $this->upsertGetId('expenses', ['gym_id' => $gym->id, 'name' => "{$prefix} ".ucfirst($category).' Expense'], [
                'amount' => 1000 + ($index * 250),
                'date' => CarbonImmutable::today()->subDays($index + 1)->toDateString(),
                'due_date' => CarbonImmutable::today()->addDays($index + 5)->toDateString(),
                'paid_at' => $index % 2 === 0 ? CarbonImmutable::today()->subDays($index)->toDateTimeString() : null,
                'category' => $category,
                'status' => $index % 2 === 0 ? 'paid' : 'pending',
                'vendor' => "{$prefix} Vendor {$index}",
                'notes' => 'Temporary expense for dashboard testing.',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    private function upsertGetId(string $table, array $match, array $data): int
    {
        DB::table($table)->updateOrInsert($match, array_merge($match, $data));

        return (int) DB::table($table)->where($match)->value('id');
    }
}
