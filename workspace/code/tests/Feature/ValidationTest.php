<?php

namespace Tests\Feature;

use App\Services\Api\Schemas\EnquirySchema;
use App\Services\Api\Schemas\MemberSchema;
use Illuminate\Support\Facades\Validator;
use Tests\BaseGymieTest;

class ValidationTest extends BaseGymieTest
{
    public function test_member_and_enquiry_source_validation_allows_only_requested_values(): void
    {
        foreach ([MemberSchema::storeRules(), EnquirySchema::storeRules()] as $rules) {
            foreach ($this->expectedSourceOptions() as $source) {
                $validator = Validator::make(['source' => $source], ['source' => $rules['source']]);
                $this->assertFalse($validator->fails(), "Expected source {$source} to pass validation.");
            }

            foreach (['promotions', 'others', 'online', 'social_media', 'walk_in'] as $legacySource) {
                $validator = Validator::make(['source' => $legacySource], ['source' => $rules['source']]);
                $this->assertTrue($validator->fails(), "Expected legacy source {$legacySource} to fail validation.");
            }
        }

        $this->logPass(__FUNCTION__);
    }


    public function test_feature_two_enquiry_dob_remains_nullable_in_api_validation(): void
    {
        $rules = EnquirySchema::storeRules();

        $this->assertArrayHasKey('dob', $rules);
        $this->assertContains('nullable', $rules['dob']);
        $this->assertContains('date', $rules['dob']);
        $this->logPass(__FUNCTION__);
    }
}
