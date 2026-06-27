<?php

namespace Tests\Security;

use Tests\BaseGymieTest;

class SecurityTest extends BaseGymieTest
{
    public function test_feature_one_removes_stale_goal_attack_surface_from_runtime_code(): void
    {
        $runtimeFiles = [
            'app/Filament/Resources/Enquiries/Schemas/EnquiryForm.php',
            'app/Filament/Resources/Members/Schemas/MemberForm.php',
            'app/Services/Api/Schemas/EnquirySchema.php',
            'app/Services/Api/Schemas/MemberSchema.php',
            'app/Models/Enquiry.php',
            'app/Models/Member.php',
            'app/Services/Members/MemberExcelService.php',
        ];

        foreach ($runtimeFiles as $file) {
            $contents = $this->fileContents($file);
            $this->assertStringNotContainsString("'goal'", $contents, "{$file} still references goal.");
            $this->assertStringNotContainsString('app.options.goal', $contents, "{$file} still references goal translations.");
            $this->assertStringNotContainsString('app.fields.goal', $contents, "{$file} still references goal field translations.");
        }

        $this->logPass(__FUNCTION__);
    }
}
