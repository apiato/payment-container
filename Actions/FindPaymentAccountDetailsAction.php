<?php

namespace App\Modules\Payment\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Modules\Payment\Models\PaymentAccount;
use App\Modules\Payment\UI\API\Requests\FindPaymentAccountRequest;
use App\Ship\Parents\Actions\Action;

class FindPaymentAccountDetailsAction extends Action
{
    public function run(FindPaymentAccountRequest $data): PaymentAccount
    {
        $user = Apiato::call('Authentication@GetAuthenticatedUserTask');

        $paymentAccount = Apiato::call('Payment@FindPaymentAccountByIdTask', [$data->id]);

        // check if this account belongs to our user
        Apiato::call('Payment@CheckIfPaymentAccountBelongsToUserTask', [$user, $paymentAccount]);

        return $paymentAccount;
    }
}
