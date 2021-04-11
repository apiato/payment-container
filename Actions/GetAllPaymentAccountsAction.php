<?php

namespace App\Containers\VendorSection\Payment\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\AppSection\Authentication\Tasks\GetAuthenticatedUserTask;
use App\Containers\VendorSection\Payment\Tasks\GetAllPaymentAccountsTask;
use App\Ship\Parents\Actions\Action;

class GetAllPaymentAccountsAction extends Action
{
	public function run()
	{
		$user = Apiato::call(GetAuthenticatedUserTask::class);

		$paymentAccounts = Apiato::call(GetAllPaymentAccountsTask::class,
			[],
			[
				'ordered',
				['filterByUser' => [$user]]
			]
		);

		return $paymentAccounts;
	}
}
