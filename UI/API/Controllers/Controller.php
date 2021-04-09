<?php

namespace App\Containers\VendorSection\Payment\UI\API\Controllers;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\VendorSection\Payment\UI\API\Requests\DeletePaymentAccountRequest;
use App\Containers\VendorSection\Payment\UI\API\Requests\FindPaymentAccountRequest;
use App\Containers\VendorSection\Payment\UI\API\Requests\GetAllPaymentAccountsRequest;
use App\Containers\VendorSection\Payment\UI\API\Requests\UpdatePaymentAccountRequest;
use App\Containers\VendorSection\Payment\UI\API\Transformers\PaymentAccountTransformer;
use App\Ship\Parents\Controllers\ApiController;
use Illuminate\Http\JsonResponse;

class Controller extends ApiController
{
    public function getAllPaymentAccounts(GetAllPaymentAccountsRequest $request): array
    {
        $paymentAccounts = Apiato::call('Payment@GetAllPaymentAccountsAction');
        return $this->transform($paymentAccounts, PaymentAccountTransformer::class);
    }

    public function getPaymentAccount(FindPaymentAccountRequest $request): array
    {
        $paymentAccount = Apiato::call('Payment@FindPaymentAccountDetailsAction', [$request]);
        return $this->transform($paymentAccount, PaymentAccountTransformer::class);
    }

    public function updatePaymentAccount(UpdatePaymentAccountRequest $request): array
    {
        $paymentAccount = Apiato::call('Payment@UpdatePaymentAccountAction', [$request]);
        return $this->transform($paymentAccount, PaymentAccountTransformer::class);
    }

    public function deletePaymentAccount(DeletePaymentAccountRequest $request): JsonResponse
    {
        Apiato::call('Payment@DeletePaymentAccountAction', [$request]);
        return $this->noContent();
    }
}
