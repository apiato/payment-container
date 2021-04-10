<?php

namespace App\Containers\VendorSection\Payment\Traits;

use App\Containers\VendorSection\Payment\Models\PaymentTransaction;
use App\Containers\VendorSection\Stripe\Tasks\ChargeWithStripeTask;

trait MockablePaymentsTrait
{
    public function mockPayments(): void
    {
        // Mock Stripe charging
        if (class_exists($chargeWithStripeTask = ChargeWithStripeTask::class)) {
            $this->mockIt($chargeWithStripeTask)
                ->shouldReceive('charge')
                ->andReturn(new PaymentTransaction([
                        'user_id' => 1,

                        'gateway' => 'Stripe',
                        'transaction_id' => 'tx_1234567890',
                        'status' => 'success',
                        'is_successful' => true,

                        'amount' => '100',
                        'currency' => 'USD',

                        'data' => [],
                        'custom' => [],
                    ])
                );
        }
    }
}
