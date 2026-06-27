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
        $legacySourceMap = [
            'promotions' => 'other',
            'others' => 'other',
            'online' => 'website',
            'social_media' => 'instagram',
            'walk_in' => 'other',
        ];

        foreach (['enquiries', 'members'] as $table) {
            if (Schema::hasTable($table) && Schema::hasColumn($table, 'source')) {
                foreach ($legacySourceMap as $from => $to) {
                    DB::table($table)
                        ->where('source', $from)
                        ->update(['source' => $to]);
                }
            }
        }

        $this->setMembersSourceDefault('word_of_mouth');

        if (Schema::hasTable('enquiries') && Schema::hasColumn('enquiries', 'goal')) {
            Schema::table('enquiries', function (Blueprint $table): void {
                $table->dropColumn('goal');
            });
        }

        if (Schema::hasTable('members') && Schema::hasColumn('members', 'goal')) {
            Schema::table('members', function (Blueprint $table): void {
                $table->dropColumn('goal');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('enquiries') && ! Schema::hasColumn('enquiries', 'goal')) {
            Schema::table('enquiries', function (Blueprint $table): void {
                $table->string('goal')->nullable()->after('source');
            });
        }

        if (Schema::hasTable('members') && ! Schema::hasColumn('members', 'goal')) {
            Schema::table('members', function (Blueprint $table): void {
                $table->string('goal')->nullable()->after('source');
            });
        }

        $this->setMembersSourceDefault('promotions');
    }

    private function setMembersSourceDefault(string $default): void
    {
        if (! Schema::hasTable('members') || ! Schema::hasColumn('members', 'source')) {
            return;
        }

        $driver = DB::getDriverName();

        if ($driver === 'mysql' || $driver === 'mariadb') {
            DB::statement("ALTER TABLE `members` MODIFY `source` VARCHAR(255) NULL DEFAULT '{$default}'");

            return;
        }

        if ($driver === 'pgsql') {
            DB::statement("ALTER TABLE members ALTER COLUMN source SET DEFAULT '{$default}'");
        }
    }
};
