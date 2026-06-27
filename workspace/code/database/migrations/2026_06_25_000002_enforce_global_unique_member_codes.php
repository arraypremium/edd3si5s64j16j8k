<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    private const PREFIX = 'M-';

    private const CHARACTERS = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';

    public function up(): void
    {
        if (! Schema::hasTable('members') || ! Schema::hasColumn('members', 'code')) {
            return;
        }

        $used = [];
        $members = DB::table('members')
            ->select(['id', 'code'])
            ->orderBy('id')
            ->get();

        foreach ($members as $member) {
            $code = is_string($member->code) ? strtoupper(trim($member->code)) : '';

            if (! $this->isValidCode($code) || isset($used[$code])) {
                $code = $this->nextAvailableCode($used);
                DB::table('members')
                    ->where('id', $member->id)
                    ->update(['code' => $code]);
            }

            $used[$code] = true;
        }

        if (! $this->hasUniqueCodeIndex()) {
            Schema::table('members', function (Blueprint $table): void {
                $table->unique('code', 'members_code_global_unique');
            });
        }
    }

    public function down(): void
    {
        if (! Schema::hasTable('members')) {
            return;
        }

        if ($this->indexExists('members_code_global_unique')) {
            Schema::table('members', function (Blueprint $table): void {
                $table->dropUnique('members_code_global_unique');
            });
        }
    }

    /**
     * @param  array<string, bool>  $used
     */
    private function nextAvailableCode(array $used): string
    {
        foreach (str_split(self::CHARACTERS) as $first) {
            foreach (str_split(self::CHARACTERS) as $second) {
                foreach (str_split(self::CHARACTERS) as $third) {
                    $candidate = self::PREFIX.$first.$second.$third;

                    if (! isset($used[$candidate])) {
                        return $candidate;
                    }
                }
            }
        }

        throw new RuntimeException('Unable to backfill member codes because the M-### code space is exhausted.');
    }

    private function isValidCode(string $code): bool
    {
        return preg_match('/^M-[A-Z0-9]{3}$/', $code) === 1;
    }

    private function hasUniqueCodeIndex(): bool
    {
        $driver = DB::getDriverName();

        if ($driver === 'mysql' || $driver === 'mariadb') {
            $database = DB::getDatabaseName();

            return DB::table('information_schema.statistics')
                ->where('table_schema', $database)
                ->where('table_name', 'members')
                ->where('column_name', 'code')
                ->where('non_unique', 0)
                ->exists();
        }

        if ($driver === 'sqlite') {
            $indexes = DB::select("PRAGMA index_list('members')");

            foreach ($indexes as $index) {
                if ((int) ($index->unique ?? 0) !== 1) {
                    continue;
                }

                $columns = DB::select("PRAGMA index_info('{$index->name}')");
                foreach ($columns as $column) {
                    if (($column->name ?? null) === 'code') {
                        return true;
                    }
                }
            }

            return false;
        }

        if ($driver === 'pgsql') {
            return DB::table('pg_indexes')
                ->where('tablename', 'members')
                ->where('indexdef', 'like', '%UNIQUE%')
                ->where('indexdef', 'like', '%(code)%')
                ->exists();
        }

        return $this->indexExists('members_code_global_unique');
    }

    private function indexExists(string $index): bool
    {
        $driver = DB::getDriverName();

        if ($driver === 'mysql' || $driver === 'mariadb') {
            $database = DB::getDatabaseName();

            return DB::table('information_schema.statistics')
                ->where('table_schema', $database)
                ->where('table_name', 'members')
                ->where('index_name', $index)
                ->exists();
        }

        if ($driver === 'sqlite') {
            $indexes = DB::select("PRAGMA index_list('members')");

            foreach ($indexes as $row) {
                if (($row->name ?? null) === $index) {
                    return true;
                }
            }

            return false;
        }

        if ($driver === 'pgsql') {
            return DB::table('pg_indexes')
                ->where('tablename', 'members')
                ->where('indexname', $index)
                ->exists();
        }

        return false;
    }
};
