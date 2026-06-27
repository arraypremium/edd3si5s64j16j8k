<?php

namespace Database\Seeders;

use App\Models\SystemRole;
use Illuminate\Database\Seeder;

class SystemRolesSeeder extends Seeder
{
    public function run(): void
    {
        $roles = [
            [
                'name' => 'super_admin',
                'label' => 'Super Administrator',
                'description' => 'Full system access. Manages all businesses, plans, and platform settings.',
            ],
            [
                'name' => 'billing_admin',
                'label' => 'Billing Administrator',
                'description' => 'Manages billing, subscriptions, invoices, and payment processing.',
            ],
            [
                'name' => 'support_admin',
                'label' => 'Support Administrator',
                'description' => 'Handles support tickets, customer issues, and facility escalations.',
            ],
        ];

        foreach ($roles as $role) {
            SystemRole::firstOrCreate(
                ['name' => $role['name']],
                $role
            );
        }
    }
}
