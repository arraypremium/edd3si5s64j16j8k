<?php

namespace Tests\Feature;

use App\Models\Enquiry;
use App\Models\Member;
use App\Services\Api\Schemas\EnquirySchema;
use App\Services\Api\Schemas\MemberSchema;
use Tests\BaseGymieTest;

class ApiTest extends BaseGymieTest
{
    public function test_feature_one_api_resources_include_source_and_exclude_goal(): void
    {
        $member = MemberSchema::resource(new Member(['name' => 'API Member', 'email' => 'api.member@example.com', 'source' => 'facebook']));
        $enquiry = EnquirySchema::resource(new Enquiry(['user_id' => 1, 'name' => 'API Lead', 'email' => 'api.lead@example.com', 'source' => 'justdial']));

        $this->assertSame('facebook', $member['source']);
        $this->assertSame('justdial', $enquiry['source']);
        $this->assertArrayNotHasKey('goal', $member);
        $this->assertArrayNotHasKey('goal', $enquiry);
        $this->logPass(__FUNCTION__);
    }
}
