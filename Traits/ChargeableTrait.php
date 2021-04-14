<?php

namespace App\Containers\VendorSection\Payment\Traits;

use App\Containers\VendorSection\Payment\Gateway\PaymentsGateway;
use App\Containers\VendorSection\Payment\Models\PaymentAccount;
use App\Containers\VendorSection\Payment\Models\PaymentTransaction;
use MohammadAlavi\ShoppingCart\Models\ShoppingCart;

trait ChargeableTrait
{
    public function purchaseShoppingCart(PaymentAccount $account, ShoppingCart $cart): PaymentTransaction
    {
        /**
         * get the "value" of the shopping cart
         * Note that MONEY stores the values internally as integers with the smallest currency value (e.g., 500 means 5.00 USD).
         * Basically, we need to re-format it to a respective float value. However, the problem is, that some currencies do not have
         * "smaller" currencies (cents), like others do. JPY (Yen) is such an example.
         * In order to handle this "automatically", we simply use the formatXXX() functions from the shopping cart!
         */
        $amount = $cart->formatMoney($cart->getTotal());
        $amount = (float)$amount;

        $currency = $cart->getTotal()->getCurrency();

        $transaction = $this->charge($account, $amount, $currency);

        $custom = $transaction->custom ?: [];
        $transaction->custom = array_merge(
            $custom,
            ['cart' => $cart]
        );
        $transaction->save();

        return $transaction;
    }

    public function charge(PaymentAccount $account, $amount, $currency = null): PaymentTransaction
    {
	    return app(PaymentsGateway::class)->charge($this, $account, $amount, $currency);
    }
}
