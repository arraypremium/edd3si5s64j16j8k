<?php

namespace Tests;

use Tests\Helpers\TestLogger;

abstract class BaseGymieTest extends TestCase
{
    protected int|string|null $superAdminId = null;

    protected int|string|null $businessAdminId = null;

    protected function setUp(): void
    {
        parent::setUp();

        $this->superAdminId = env('SUPER_ADMIN_ID');
        $this->businessAdminId = env('BUSINESS_ADMIN_ID');
        TestLogger::init();
    }

    /**
     * @return list<string>
     */
    protected function expectedSourceOptions(): array
    {
        return [
            'word_of_mouth',
            'google_business_account',
            'website',
            'instagram',
            'facebook',
            'whatsapp',
            'justdial',
            'referral',
            'other',
        ];
    }

    protected function projectFile(string $relativePath): string
    {
        return base_path($relativePath);
    }

    protected function fileContents(string $relativePath): string
    {
        $path = $this->projectFile($relativePath);
        $this->assertFileExists($path);

        return (string) file_get_contents($path);
    }

    protected function logPass(string $testName): void
    {
        TestLogger::pass(static::class, $testName);
    }
}
