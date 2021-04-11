<?php

namespace App\Containers\VendorSection\Payment\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\AppSection\Authentication\Tasks\GetAuthenticatedUserTask;
use App\Containers\VendorSection\Payment\Tasks\CheckIfPaymentAccountBelongsToUserTask;
use App\Containers\VendorSection\Payment\Tasks\DeletePaymentAccountTask;
use App\Containers\VendorSection\Payment\Tasks\FindPaymentAccountByIdTask;
use App\Containers\VendorSection\Payment\UI\API\Requests\DeletePaymentAccountRequest;
use App\Ship\Parents\Actions\Action;

class DeletePaymentAccountAction extends Action
{
	public function run(DeletePaymentAccountRequest $data): void
	{
		$user = Apiato::call(GetAuthenticatedUserTask::class);

		$paymentAccount = Apiato::call(FindPaymentAccountByIdTask::class, [$data->id]);

		// check if this account belongs to our user
		Apiato::call(CheckIfPaymentAccountBelongsToUserTask::class, [$user, $paymentAccount]);

		Apiato::call(DeletePaymentAccountTask::class, [$paymentAccount]);
	}
}
