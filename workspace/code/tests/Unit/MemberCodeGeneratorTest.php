<?php

namespace Tests\Unit;

use App\Models\Member;
use App\Support\Members\MemberCodeGenerator;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MemberCodeGeneratorTest extends TestCase
{
    use RefreshDatabase;

    public function test_generated_member_code_uses_m_prefix_and_three_uppercase_alphanumeric_characters(): void
    {
        $code = MemberCodeGenerator::generate();

        $this->assertMatchesRegularExpression('/^M-[A-Z0-9]{3}$/', $code);
    }

    public function test_member_creation_assigns_global_unique_m_prefixed_codes(): void
    {
        $first = Member::factory()->create();
        $second = Member::factory()->create();

        $this->assertMatchesRegularExpression('/^M-[A-Z0-9]{3}$/', (string) $first->code);
        $this->assertMatchesRegularExpression('/^M-[A-Z0-9]{3}$/', (string) $second->code);
        $this->assertNotSame($first->code, $second->code);
    }

    public function test_member_code_is_locked_after_creation(): void
    {
        $member = Member::factory()->create();
        $originalCode = $member->code;

        $member->update(['code' => 'M-ZZZ']);

        $this->assertSame($originalCode, $member->refresh()->code);
    }

    public function test_soft_deleted_member_code_is_not_reused(): void
    {
        $member = Member::factory()->create();
        $member->delete();

        $nextCode = MemberCodeGenerator::generate();

        $this->assertNotSame($member->code, $nextCode);
        $this->assertMatchesRegularExpression('/^M-[A-Z0-9]{3}$/', $nextCode);
    }
}
