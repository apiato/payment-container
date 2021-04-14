<?php

namespace App\Containers\VendorSection\Payment\Actions;

use App\Containers\AppSection\Authentication\Tasks\GetAuthenticatedUserTask;
use App\Containers\VendorSection\Payment\Tasks\GetAllPaymentAccountsTask;
use App\Ship\Parents\Actions\Action;

class GetAllPaymentAccountsAction extends Action
{
	public function run()
	{
		$user = app(GetAuthenticatedUserTask::class)->run();

		return app(GetAllPaymentAccountsTask::class)->ordered()->filterByUser($user)->run();
	}
}
