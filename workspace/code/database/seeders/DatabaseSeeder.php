<?php

namespace Database\Seeders;

use App\Models\Gym;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Nnjeim\World\Actions\SeedAction;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        try {
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
            DB::statement('ALTER TABLE model_has_roles MODIFY gym_id BIGINT UNSIGNED NOT NULL DEFAULT 1;');
            DB::statement('ALTER TABLE model_has_permissions MODIFY gym_id BIGINT UNSIGNED NOT NULL DEFAULT 1;');
            DB::statement('ALTER TABLE roles MODIFY gym_id BIGINT UNSIGNED NULL DEFAULT NULL;');
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        } catch (\Exception $e) {
            // Ignore database-engine-specific ALTER failures during local setup.
        }

        $gym = Gym::firstOrCreate(
            ['name' => 'Central Gym'],
            [
                'address' => '123 Multi-Gym Master Street',
                'status' => 'active',
            ]
        );

        if (function_exists('setPermissionsTeamId')) {
            setPermissionsTeamId($gym->id);
        }

        DB::table('system_admins')->updateOrInsert(
            ['username' => 'admin'],
            [
                'name' => 'System Administrator',
                'password' => \Illuminate\Support\Facades\Hash::make('Admin@12345'),
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        $this->call([
            SystemRolesSeeder::class,
            SeedAction::class,
            UserSeeder::class,
            ServiceSeeder::class,
            PlanSeeder::class,
            EnquirySeeder::class,
            FollowUpSeeder::class,
            MemberSeeder::class,
            SubscriptionSeeder::class,
            InvoiceSeeder::class,
            ExpenseSeeder::class,
        ]);
    }
}
