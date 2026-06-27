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
            // Repair any Super Admin users (ID 1, ID 17, or name containing 'Admin') to have username 'admin'
            DB::table('users')
                ->where('id', 1)
                ->orWhere('id', 17)
                ->orWhere('name', 'like', '%Admin%')
                ->update(['username' => 'admin', 'deleted_at' => null]);

            // Force update the superadmin's password correctly using Eloquent (which automatically hashes it once)
            $admin = \App\Models\User::withTrashed()->where('username', 'admin')->first();
            if ($admin) {
                $admin->password = 'Admin@12345';
                $admin->deleted_at = null; // Strictly restore any soft-deleted state!
                $admin->save();
            }

            // Repair any other null or empty usernames to prevent login issues
            $users = DB::table('users')->whereNull('username')->orWhere('username', '')->get();
            foreach ($users as $user) {
                $username = 'user_' . $user->id;
                DB::table('users')->where('id', $user->id)->update(['username' => $username]);
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
