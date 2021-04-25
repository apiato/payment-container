<?php

namespace App\Containers\Vendor\Payment\Actions;

use App\Containers\AppSection\Authentication\Tasks\GetAuthenticatedUserTask;
use App\Containers\Vendor\Payment\Tasks\GetAllPaymentAccountsTask;
use App\Ship\Parents\Actions\Action;

class GetAllPaymentAccountsAction extends Action
{
	public function run()
	{
		$user = app(GetAuthenticatedUserTask::class)->run();

		return app(GetAllPaymentAccountsTask::class)->ordered()->filterByUser($user)->run();
	}
}
