<?php

namespace App\Containers\VendorSection\Payment\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\VendorSection\Payment\UI\API\Requests\DeletePaymentAccountRequest;
use App\Ship\Parents\Actions\Action;

class DeletePaymentAccountAction extends Action
{
    public function run(DeletePaymentAccountRequest $data): void
    {
        $user = Apiato::call('Authentication@GetAuthenticatedUserTask');

        $paymentAccount = Apiato::call('Payment@FindPaymentAccountByIdTask', [$data->id]);

        // check if this account belongs to our user
        Apiato::call('Payment@CheckIfPaymentAccountBelongsToUserTask', [$user, $paymentAccount]);

        Apiato::call('Payment@DeletePaymentAccountTask', [$paymentAccount]);
    }
}
