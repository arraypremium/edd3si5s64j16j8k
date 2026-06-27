<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (Schema::hasTable('users')) {
            // Force restore any soft-deleted Super Admin accounts to make them fully active for Auth::attempt
            DB::table('users')
                ->where('username', 'admin')
                ->orWhere('username', 'test')
                ->orWhere('id', 1)
                ->orWhere('id', 17)
                ->update([
                    'deleted_at' => null,
                    'status' => 'active'
                ]);

            // Also reset the password to ensure it matches 'Admin@12345'
            $admin = \App\Models\User::withTrashed()->where('username', 'admin')->first();
            if ($admin) {
                $admin->password = 'Admin@12345';
                $admin->deleted_at = null;
                $admin->save();
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // No-op
    }
};
