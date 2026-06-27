<?php

namespace Tests\Helpers;

use Throwable;

final class TestLogger
{
    private static ?string $file = null;

    public static function init(): void
    {
        if (self::$file !== null) {
            return;
        }

        $timestamp = getenv('TEST_RUN_TIMESTAMP') ?: date('Ymd-His');
        $dir = base_path('tests/results');

        if (! is_dir($dir)) {
            mkdir($dir, 0775, true);
        }

        self::$file = $dir.'/error-'.$timestamp.'.txt';

        if (! file_exists(self::$file)) {
            file_put_contents(self::$file, "[".date('Y-m-d H:i:s')."] Test run initialized.\n");
        }
    }

    public static function pass(string $class, string $method): void
    {
        self::init();
        file_put_contents(self::$file, "[".date('Y-m-d H:i:s')."] ✅ PASSED: {$class}::{$method}\n", FILE_APPEND);
    }

    public static function fail(string $class, string $method, Throwable $throwable, string $expected = 'Test assertion passes', string $got = 'Exception thrown'): void
    {
        self::init();
        $message = sprintf(
            "[%s] ❌ FAILED: %s::%s\n  → Error    : %s\n  → File     : %s\n  → Line     : %s\n  → Expected : %s\n  → Got      : %s\n  → Hint     : Review the changed source/goal implementation for Feature 1.\n",
            date('Y-m-d H:i:s'),
            $class,
            $method,
            $throwable->getMessage(),
            $throwable->getFile(),
            (string) $throwable->getLine(),
            $expected,
            $got,
        );

        file_put_contents(self::$file, $message, FILE_APPEND);
    }
}
