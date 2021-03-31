<?php

namespace App\Modules\Payment\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Ship\Parents\Actions\Action;

class GetAllPaymentAccountsAction extends Action
{
    public function run()
    {
        $user = Apiato::call('Authentication@GetAuthenticatedUserTask');

        $paymentAccounts = Apiato::call('Payment@GetAllPaymentAccountsTask',
            [],
            [
                'ordered',
                ['filterByUser' => [$user]]
            ]
        );

        return $paymentAccounts;
    }
}
