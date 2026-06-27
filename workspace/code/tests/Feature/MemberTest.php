<?php

namespace Tests\Feature;

use App\Models\Member;
use App\Services\Api\Schemas\MemberSchema;
use Tests\BaseGymieTest;

class MemberTest extends BaseGymieTest
{
    public function test_member_form_uses_requested_source_options_and_removes_goal(): void
    {
        $contents = $this->fileContents('app/Filament/Resources/Members/Schemas/MemberForm.php');

        foreach ($this->expectedSourceOptions() as $source) {
            $this->assertStringContainsString("'{$source}' => __('app.options.source.{$source}')", $contents);
        }

        $this->assertStringContainsString("->default('word_of_mouth')", $contents);
        $this->assertStringNotContainsString("Select::make('goal')", $contents);
        $this->assertStringNotContainsString('app.options.goal', $contents);
        $this->logPass(__FUNCTION__);
    }

    public function test_member_model_and_api_schema_do_not_expose_goal(): void
    {
        $model = new Member();
        $this->assertNotContains('goal', $model->getFillable());

        $storeRules = MemberSchema::storeRules();
        $updateRules = MemberSchema::updateRules(1);

        $this->assertArrayNotHasKey('goal', $storeRules);
        $this->assertArrayNotHasKey('goal', $updateRules);

        $resource = MemberSchema::resource(new Member([
            'name' => 'Feature Member',
            'email' => 'feature.member@example.com',
            'source' => 'instagram',
        ]));

        $this->assertArrayHasKey('source', $resource);
        $this->assertArrayNotHasKey('goal', $resource);
        $this->logPass(__FUNCTION__);
    }

    public function test_feature_three_members_receive_locked_global_m_prefixed_codes(): void
    {
        $member = Member::factory()->create();
        $originalCode = $member->code;

        $this->assertMatchesRegularExpression('/^M-[A-Z0-9]{3}$/', (string) $originalCode);

        $member->update(['code' => 'M-ZZZ']);

        $this->assertSame($originalCode, $member->refresh()->code);
        $this->logPass(__FUNCTION__);
    }
}
