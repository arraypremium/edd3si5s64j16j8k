<?php

namespace Tests\Feature;

use App\Models\Enquiry;
use App\Services\Api\Schemas\EnquirySchema;
use Tests\BaseGymieTest;

class LeadTest extends BaseGymieTest
{
    public function test_enquiry_form_uses_requested_source_options_and_removes_goal(): void
    {
        $contents = $this->fileContents('app/Filament/Resources/Enquiries/Schemas/EnquiryForm.php');

        foreach ($this->expectedSourceOptions() as $source) {
            $this->assertStringContainsString("'{$source}' => __('app.options.source.{$source}')", $contents);
        }

        $this->assertStringContainsString("->default('word_of_mouth')", $contents);
        $this->assertStringNotContainsString("Select::make('goal')", $contents);
        $this->assertStringNotContainsString('app.options.goal', $contents);
        $this->logPass(__FUNCTION__);
    }

    public function test_enquiry_model_and_api_schema_do_not_expose_goal(): void
    {
        $model = new Enquiry();
        $this->assertNotContains('goal', $model->getFillable());

        $storeRules = EnquirySchema::storeRules();
        $updateRules = EnquirySchema::updateRules(1);

        $this->assertArrayNotHasKey('goal', $storeRules);
        $this->assertArrayNotHasKey('goal', $updateRules);

        $resource = EnquirySchema::resource(new Enquiry([
            'user_id' => 1,
            'name' => 'Feature Lead',
            'email' => 'feature.lead@example.com',
            'source' => 'website',
        ]));

        $this->assertArrayHasKey('source', $resource);
        $this->assertArrayNotHasKey('goal', $resource);
        $this->logPass(__FUNCTION__);
    }


    public function test_feature_two_enquiry_dob_is_optional_and_lead_owner_labels_are_clean(): void
    {
        $contents = $this->fileContents('app/Filament/Resources/Enquiries/Schemas/EnquiryForm.php');

        $this->assertStringContainsString("DatePicker::make('dob')", $contents);
        $this->assertStringNotContainsString("DatePicker::make('dob')
                            ->required()", $contents);
        $this->assertStringContainsString("LOWER(name) != ?", $contents);
        $this->assertStringContainsString("orWhereNotIn('username', ['admin', 'test'])", $contents);
        $this->assertStringContainsString('$displayName = trim', $contents);

        $this->logPass(__FUNCTION__);
    }
}
