<?php

namespace App\Containers\Vendor\Payment\Actions;

use App\Containers\AppSection\Authentication\Tasks\GetAuthenticatedUserTask;
use App\Containers\Vendor\Payment\Models\PaymentAccount;
use App\Containers\Vendor\Payment\Tasks\CheckIfPaymentAccountBelongsToUserTask;
use App\Containers\Vendor\Payment\Tasks\FindPaymentAccountByIdTask;
use App\Containers\Vendor\Payment\UI\API\Requests\FindPaymentAccountRequest;
use App\Ship\Parents\Actions\Action;

class FindPaymentAccountDetailsAction extends Action
{
	public function run(FindPaymentAccountRequest $request): PaymentAccount
	{
		$user = app(GetAuthenticatedUserTask::class)->run();

		$paymentAccount = app(FindPaymentAccountByIdTask::class)->run($request->id);

		// check if this account belongs to our user
		app(CheckIfPaymentAccountBelongsToUserTask::class)->run($user, $paymentAccount);

		return $paymentAccount;
	}
}
