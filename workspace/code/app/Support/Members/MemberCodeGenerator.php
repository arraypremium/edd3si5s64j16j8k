<?php

namespace App\Support\Members;

use App\Models\Member;
use RuntimeException;

final class MemberCodeGenerator
{
    public const PREFIX = 'M-';

    public const RANDOM_LENGTH = 3;

    public const CHARACTERS = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';

    private const MAX_RANDOM_ATTEMPTS = 500;

    private function __construct() {}

    public static function generate(?int $ignoreMemberId = null): string
    {
        for ($attempt = 0; $attempt < self::MAX_RANDOM_ATTEMPTS; $attempt++) {
            $candidate = self::PREFIX.self::randomSuffix();

            if (! self::exists($candidate, $ignoreMemberId)) {
                return $candidate;
            }
        }

        foreach (self::allPossibleCodes() as $candidate) {
            if (! self::exists($candidate, $ignoreMemberId)) {
                return $candidate;
            }
        }

        throw new RuntimeException('Unable to generate a unique member code because the M-### code space is exhausted.');
    }

    public static function isValid(?string $code): bool
    {
        return is_string($code) && preg_match('/^M-[A-Z0-9]{3}$/', $code) === 1;
    }

    public static function randomSuffix(): string
    {
        $characters = self::CHARACTERS;
        $lastIndex = strlen($characters) - 1;
        $code = '';

        for ($index = 0; $index < self::RANDOM_LENGTH; $index++) {
            $code .= $characters[random_int(0, $lastIndex)];
        }

        return $code;
    }

    private static function exists(string $code, ?int $ignoreMemberId = null): bool
    {
        return Member::withTrashed()
            ->withoutGlobalScopes()
            ->where('code', $code)
            ->when($ignoreMemberId !== null, fn ($query) => $query->whereKeyNot($ignoreMemberId))
            ->exists();
    }

    /**
     * @return iterable<int, string>
     */
    private static function allPossibleCodes(): iterable
    {
        $characters = str_split(self::CHARACTERS);

        foreach ($characters as $first) {
            foreach ($characters as $second) {
                foreach ($characters as $third) {
                    yield self::PREFIX.$first.$second.$third;
                }
            }
        }
    }
}
