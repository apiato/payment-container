<?php

namespace App\Containers\VendorSection\Payment\UI\API\Controllers;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\VendorSection\Payment\Actions\DeletePaymentAccountAction;
use App\Containers\VendorSection\Payment\Actions\FindPaymentAccountDetailsAction;
use App\Containers\VendorSection\Payment\Actions\GetAllPaymentAccountsAction;
use App\Containers\VendorSection\Payment\Actions\UpdatePaymentAccountAction;
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
		$paymentAccounts = Apiato::call(GetAllPaymentAccountsAction::class);
		return $this->transform($paymentAccounts, PaymentAccountTransformer::class);
	}

	public function getPaymentAccount(FindPaymentAccountRequest $request): array
	{
		$paymentAccount = Apiato::call(FindPaymentAccountDetailsAction::class, [$request]);
		return $this->transform($paymentAccount, PaymentAccountTransformer::class);
	}

	public function updatePaymentAccount(UpdatePaymentAccountRequest $request): array
	{
		$paymentAccount = Apiato::call(UpdatePaymentAccountAction::class, [$request]);
		return $this->transform($paymentAccount, PaymentAccountTransformer::class);
	}

	public function deletePaymentAccount(DeletePaymentAccountRequest $request): JsonResponse
	{
		Apiato::call(DeletePaymentAccountAction::class, [$request]);
		return $this->noContent();
	}
}
