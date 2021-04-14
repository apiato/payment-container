<?php

namespace App\Containers\VendorSection\Payment\Actions;

use App\Containers\AppSection\Authentication\Tasks\GetAuthenticatedUserTask;
use App\Containers\VendorSection\Payment\Models\PaymentAccount;
use App\Containers\VendorSection\Payment\Tasks\CheckIfPaymentAccountBelongsToUserTask;
use App\Containers\VendorSection\Payment\Tasks\FindPaymentAccountByIdTask;
use App\Containers\VendorSection\Payment\Tasks\UpdatePaymentAccountTask;
use App\Containers\VendorSection\Payment\UI\API\Requests\UpdatePaymentAccountRequest;
use App\Ship\Parents\Actions\Action;

class UpdatePaymentAccountAction extends Action
{
	public function run(UpdatePaymentAccountRequest $request): PaymentAccount
	{
		$user = app(GetAuthenticatedUserTask::class)->run();

		$paymentAccount = app(FindPaymentAccountByIdTask::class)->run($request->id);

		// check if this account belongs to our user
		app(CheckIfPaymentAccountBelongsToUserTask::class)->run($user, $paymentAccount);

		$sanitizedData = $request->sanitizeInput([
			'name'
		]);

		return app(UpdatePaymentAccountTask::class)->run($paymentAccount, $sanitizedData);
	}
}
