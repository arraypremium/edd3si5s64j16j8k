<?php

namespace Database\Seeders;

use App\Models\Gym;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class GymTenancySeeder extends Seeder
{
    public function run(): void
    {
        if (! Schema::hasTable('gyms')) {
            $this->command->error("⚠️ The 'gyms' database table does not exist yet.");
            $this->command->line("👉 Please execute [php artisan migrate] before running the Multi-Tenant Seeder.");

            return;
        }

        $gym = Gym::firstOrCreate(
            ['name' => 'Central Gym'],
            [
                'address' => '123 Main Fitness Street, Suite 100',
                'status' => 'active',
            ]
        );

        try {
            DB::statement("ALTER TABLE model_has_roles MODIFY gym_id BIGINT UNSIGNED NOT NULL DEFAULT 1");
            DB::statement("ALTER TABLE model_has_permissions MODIFY gym_id BIGINT UNSIGNED NOT NULL DEFAULT 1");
            DB::statement("ALTER TABLE roles MODIFY gym_id BIGINT UNSIGNED NULL DEFAULT NULL");
        } catch (\Exception $e) {
            // Continue if the current database engine rejects the ALTER syntax.
        }

        if (function_exists('setPermissionsTeamId')) {
            setPermissionsTeamId($gym->id);
        }

        if (class_exists(\Spatie\Permission\PermissionRegistrar::class)) {
            app(\Spatie\Permission\PermissionRegistrar::class)->setPermissionsTeamId($gym->id);
        }

        foreach (User::all() as $user) {
            if (! $user->gyms()->where('gyms.id', $gym->id)->exists()) {
                $user->gyms()->attach($gym->id, ['role' => null]);
            }
        }

        $tables = [
            'members',
            'enquiries',
            'follow_ups',
            'services',
            'plans',
            'subscriptions',
            'invoices',
            'expenses',
            'invoice_transactions',
        ];

        foreach ($tables as $tableName) {
            if (DB::getSchemaBuilder()->hasTable($tableName)) {
                DB::table($tableName)
                    ->whereNull('gym_id')
                    ->update(['gym_id' => $gym->id]);
            }
        }
    }
}
