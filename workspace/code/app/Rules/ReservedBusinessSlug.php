<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Str;

class ReservedBusinessSlug implements ValidationRule
{
    /**
     * @var array<int, string>
     */
    private const RESERVED = [
        'admin',
        'api',
        'app',
        'assets',
        'build',
        'css',
        'dashboard',
        'favicon.ico',
        'filament',
        'images',
        'js',
        'livewire',
        'login',
        'logout',
        'password-reset',
        'register',
        'sanctum',
        'storage',
        'system',
        'vendor',
    ];

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $slug = self::normalize($value);

        if ($slug === '') {
            $fail('The URL slug is required.');
            return;
        }

        if (! preg_match('/^[a-z0-9]+(?:-[a-z0-9]+)*$/', $slug)) {
            $fail('The URL slug may only contain lowercase letters, numbers, and single hyphens.');
            return;
        }

        if (self::isReserved($slug)) {
            $fail('This URL slug is reserved and cannot be used for a business.');
        }
    }

    public static function normalize(mixed $value): string
    {
        $value = trim((string) $value);

        if ($value === '') {
            return '';
        }

        return Str::slug($value);
    }

    public static function isReserved(string $slug): bool
    {
        return in_array(strtolower($slug), self::RESERVED, true);
    }

    public static function routePattern(): string
    {
        $reserved = implode('|', array_map(static fn (string $slug): string => preg_quote($slug, '/'), self::RESERVED));

        return '(?!(?:'.$reserved.')$)[a-z0-9]+(?:-[a-z0-9]+)*';
    }
}
