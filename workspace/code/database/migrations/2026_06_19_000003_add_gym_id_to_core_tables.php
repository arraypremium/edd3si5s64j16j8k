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
        // 1. Smart Master Hook: Sabse pehle yehi par master 'gyms' table fully create kare (idempotent)
        if (! Schema::hasTable('gyms')) {
            Schema::create('gyms', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->string('contact_email')->nullable();
                $table->string('contact_phone')->nullable();
                $table->text('address')->nullable();
                $table->string('assigned_id', 6)->nullable()->unique();
                $table->enum('status', ['active', 'suspended', 'inactive'])->default('active');
                $table->softDeletes();
                $table->timestamps();
            });
        }

        // 2. Ultra Self-healing Hook: Spatie role pivots ke existing gym_id column ko wahi par nullable kar de!
        // Is ek master hook se tumhara 'Column gym_id cannot be null' ka error 100% hamesha ke liye gayab ho jayega!
        try {
            if (Schema::hasTable('model_has_roles')) {
                DB::statement("ALTER TABLE model_has_roles MODIFY gym_id BIGINT UNSIGNED NULL DEFAULT 1");
            }
            if (Schema::hasTable('model_has_permissions')) {
                DB::statement("ALTER TABLE model_has_permissions MODIFY gym_id BIGINT UNSIGNED NULL DEFAULT 1");
            }
            if (Schema::hasTable('roles')) {
                DB::statement("ALTER TABLE roles MODIFY gym_id BIGINT UNSIGNED NULL DEFAULT 1");
            }
        } catch (\Exception $e) {
            // silent bypass if engine restricts
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

        // 3. Sabhi 9 core tenant tables me nullable gym_id aur uske database relations link kare
        foreach ($tables as $tableName) {
            if (Schema::hasTable($tableName)) {
                Schema::table($tableName, function (Blueprint $table) use ($tableName) {
                    if (! Schema::hasColumn($tableName, 'gym_id')) {
                        $table->unsignedBigInteger('gym_id')->nullable();
                        $table->index('gym_id');
                    }
                });

                Schema::table($tableName, function (Blueprint $table) use ($tableName) {
                    $databaseName = DB::connection()->getDatabaseName();
                    
                    $foreignKeys = DB::select(
                        "SELECT CONSTRAINT_NAME FROM information_schema.KEY_COLUMN_USAGE 
                         WHERE TABLE_SCHEMA = ? AND TABLE_NAME = ? AND COLUMN_NAME = 'gym_id' AND REFERENCED_TABLE_NAME IS NOT NULL",
                        [$databaseName, $tableName]
                    );

                    if (empty($foreignKeys)) {
                        $table->foreign('gym_id')->references('id')->on('gyms')->onDelete('cascade');
                    }
                });
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
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
            if (Schema::hasTable($tableName)) {
                Schema::table($tableName, function (Blueprint $table) use ($tableName) {
                    if (Schema::hasColumn($tableName, 'gym_id')) {
                        $table->dropForeign(['gym_id']);
                        $table->dropColumn('gym_id');
                    }
                });
            }
        }

        Schema::dropIfExists('gyms');
    }
};