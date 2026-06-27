<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

return new class extends Migration
{
    private const INDEX_NAME = 'gyms_url_slug_unique';

    /**
     * @var array<int, string>
     */
    private const RESERVED_SLUGS = [
        'admin', 'api', 'app', 'assets', 'build', 'css', 'dashboard', 'favicon.ico', 'filament',
        'images', 'js', 'livewire', 'login', 'logout', 'password-reset', 'register', 'sanctum',
        'storage', 'system', 'vendor',
    ];

    public function up(): void
    {
        if (! Schema::hasTable('gyms')) {
            return;
        }

        if (! Schema::hasColumn('gyms', 'url_slug')) {
            Schema::table('gyms', function (Blueprint $table): void {
                $table->string('url_slug', 80)->nullable()->after('assigned_id');
            });
        }

        $this->backfillSlugs();

        if (! $this->hasUniqueSlugIndex()) {
            Schema::table('gyms', function (Blueprint $table): void {
                $table->unique('url_slug', self::INDEX_NAME);
            });
        }
    }

    public function down(): void
    {
        if (! Schema::hasTable('gyms')) {
            return;
        }

        if ($this->indexExists(self::INDEX_NAME)) {
            Schema::table('gyms', function (Blueprint $table): void {
                $table->dropUnique(self::INDEX_NAME);
            });
        }

        if (Schema::hasColumn('gyms', 'url_slug')) {
            Schema::table('gyms', function (Blueprint $table): void {
                $table->dropColumn('url_slug');
            });
        }
    }

    private function backfillSlugs(): void
    {
        $used = [];

        DB::table('gyms')
            ->select(['id', 'url_slug', 'business_name', 'name', 'assigned_id'])
            ->orderBy('id')
            ->get()
            ->each(function (object $gym) use (&$used): void {
                $current = $this->normalizeSlug($gym->url_slug ?? null);

                if ($current !== '' && ! $this->isReserved($current) && ! isset($used[$current])) {
                    $used[$current] = true;
                    if ($current !== ($gym->url_slug ?? null)) {
                        DB::table('gyms')->where('id', $gym->id)->update(['url_slug' => $current]);
                    }

                    return;
                }

                $base = $this->normalizeSlug($gym->business_name ?? null)
                    ?: $this->normalizeSlug($gym->name ?? null)
                    ?: $this->normalizeSlug($gym->assigned_id ?? null)
                    ?: 'business-'.$gym->id;

                $slug = $this->uniqueSlug($base, $used, (int) $gym->id);
                DB::table('gyms')->where('id', $gym->id)->update(['url_slug' => $slug]);
                $used[$slug] = true;
            });
    }

    /**
     * @param  array<string, bool>  $used
     */
    private function uniqueSlug(string $base, array $used, int $id): string
    {
        $base = $this->normalizeSlug($base) ?: 'business-'.$id;

        if ($this->isReserved($base)) {
            $base = 'business-'.$base;
        }

        $candidate = $this->truncateSlug($base, 70);
        $counter = 1;

        while ($candidate === '' || $this->isReserved($candidate) || isset($used[$candidate]) || $this->slugExists($candidate, $id)) {
            $suffix = '-'.$counter;
            $candidate = $this->truncateSlug($base, 80 - strlen($suffix)).$suffix;
            $counter++;
        }

        return $candidate;
    }

    private function truncateSlug(string $slug, int $limit): string
    {
        return trim(Str::limit($slug, $limit, ''), '-');
    }

    private function normalizeSlug(mixed $value): string
    {
        $value = trim((string) $value);

        if ($value === '') {
            return '';
        }

        return Str::slug($value);
    }

    private function isReserved(string $slug): bool
    {
        return in_array(strtolower($slug), self::RESERVED_SLUGS, true);
    }

    private function slugExists(string $slug, int $ignoreId): bool
    {
        return DB::table('gyms')
            ->where('url_slug', $slug)
            ->where('id', '!=', $ignoreId)
            ->exists();
    }

    private function hasUniqueSlugIndex(): bool
    {
        $driver = DB::getDriverName();

        if ($driver === 'mysql' || $driver === 'mariadb') {
            return DB::table('information_schema.statistics')
                ->where('table_schema', DB::getDatabaseName())
                ->where('table_name', 'gyms')
                ->where('column_name', 'url_slug')
                ->where('non_unique', 0)
                ->exists();
        }

        if ($driver === 'sqlite') {
            $indexes = DB::select("PRAGMA index_list('gyms')");

            foreach ($indexes as $index) {
                if ((int) ($index->unique ?? 0) !== 1) {
                    continue;
                }

                $columns = DB::select("PRAGMA index_info('{$index->name}')");
                foreach ($columns as $column) {
                    if (($column->name ?? null) === 'url_slug') {
                        return true;
                    }
                }
            }

            return false;
        }

        if ($driver === 'pgsql') {
            return DB::table('pg_indexes')
                ->where('tablename', 'gyms')
                ->where('indexdef', 'like', '%UNIQUE%')
                ->where('indexdef', 'like', '%(url_slug)%')
                ->exists();
        }

        return $this->indexExists(self::INDEX_NAME);
    }

    private function indexExists(string $index): bool
    {
        $driver = DB::getDriverName();

        if ($driver === 'mysql' || $driver === 'mariadb') {
            return DB::table('information_schema.statistics')
                ->where('table_schema', DB::getDatabaseName())
                ->where('table_name', 'gyms')
                ->where('index_name', $index)
                ->exists();
        }

        if ($driver === 'sqlite') {
            $indexes = DB::select("PRAGMA index_list('gyms')");

            foreach ($indexes as $row) {
                if (($row->name ?? null) === $index) {
                    return true;
                }
            }

            return false;
        }

        if ($driver === 'pgsql') {
            return DB::table('pg_indexes')
                ->where('tablename', 'gyms')
                ->where('indexname', $index)
                ->exists();
        }

        return false;
    }
};
