<?php

namespace App\Containers\Vendor\Payment\Actions;

use App\Containers\AppSection\Authentication\Tasks\GetAuthenticatedUserTask;
use App\Containers\Vendor\Payment\Tasks\CheckIfPaymentAccountBelongsToUserTask;
use App\Containers\Vendor\Payment\Tasks\DeletePaymentAccountTask;
use App\Containers\Vendor\Payment\Tasks\FindPaymentAccountByIdTask;
use App\Containers\Vendor\Payment\UI\API\Requests\DeletePaymentAccountRequest;
use App\Ship\Parents\Actions\Action;

class DeletePaymentAccountAction extends Action
{
	public function run(DeletePaymentAccountRequest $request): void
	{
		$user = app(GetAuthenticatedUserTask::class)->run();

		$paymentAccount = app(FindPaymentAccountByIdTask::class)->run($request->id);

		// check if this account belongs to our user
		app(CheckIfPaymentAccountBelongsToUserTask::class)->run($user, $paymentAccount);

		app(DeletePaymentAccountTask::class)->run($paymentAccount);
	}
}
