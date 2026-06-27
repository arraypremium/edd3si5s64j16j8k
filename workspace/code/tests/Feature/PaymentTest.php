<?php

namespace Tests\Feature;

use Tests\BaseGymieTest;

class PaymentTest extends BaseGymieTest
{
    public function test_invoice_transaction_payment_files_remain_present_after_feature_one(): void
    {
        $this->assertFileExists($this->projectFile('app/Http/Controllers/Api/V1/InvoiceTransactionsController.php'));
        $this->assertFileExists($this->projectFile('app/Models/InvoiceTransaction.php'));
        $this->logPass(__FUNCTION__);
    }
}
