<?php

namespace App\Containers\Vendor\Payment\Gateway;

use App\Containers\Vendor\Payment\Contracts\ChargeableInterface;
use App\Containers\Vendor\Payment\Contracts\PaymentChargerInterface;
use App\Containers\Vendor\Payment\Exceptions\ChargerTaskDoesNotImplementInterfaceException;
use App\Containers\Vendor\Payment\Exceptions\NoChargeTaskForPaymentGatewayDefinedException;
use App\Containers\Vendor\Payment\Models\PaymentAccount;
use App\Containers\Vendor\Payment\Models\PaymentTransaction;
use App\Containers\Vendor\Payment\Tasks\CheckIfPaymentAccountBelongsToUserTask;

class PaymentsGateway
{
	public function charge(ChargeableInterface $chargeable, PaymentAccount $account, $amount, $currency = null): PaymentTransaction
	{
		$currency = ($currency === null) ? config('payment.currency') : $currency;

		// check, if the account is owned by user to be charged
		app(CheckIfPaymentAccountBelongsToUserTask::class)->run($chargeable, $account);

		$typedAccount = $account->accountable;

		$chargerTaskTaskName = config('vendor-payment.gateways.' . $typedAccount->getPaymentGatewaySlug() . '.charge_task', null);

		if ($chargerTaskTaskName === null) {
			throw new NoChargeTaskForPaymentGatewayDefinedException();
		}

		// create the task
		$chargerTask = app($chargerTaskTaskName);

		// check if it implements the required interface
		if (!$chargerTask instanceof PaymentChargerInterface) {
			throw new ChargerTaskDoesNotImplementInterfaceException();
		}

		$transaction = $chargerTask->charge($chargeable, $typedAccount, $amount, $currency);

		// now set some details of the transaction
		$transaction->user_id = $chargeable->id;
		$transaction->gateway = $typedAccount->getPaymentGatewayReadableName();
		$transaction->amount = $amount;
		$transaction->currency = $currency;

		$transaction->save();

		return $transaction;
	}
}
