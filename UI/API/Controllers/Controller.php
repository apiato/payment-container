<?php

namespace App\Containers\Vendor\Payment\UI\API\Controllers;

use App\Containers\Vendor\Payment\Actions\DeletePaymentAccountAction;
use App\Containers\Vendor\Payment\Actions\FindPaymentAccountDetailsAction;
use App\Containers\Vendor\Payment\Actions\GetAllPaymentAccountsAction;
use App\Containers\Vendor\Payment\Actions\UpdatePaymentAccountAction;
use App\Containers\Vendor\Payment\UI\API\Requests\DeletePaymentAccountRequest;
use App\Containers\Vendor\Payment\UI\API\Requests\FindPaymentAccountRequest;
use App\Containers\Vendor\Payment\UI\API\Requests\GetAllPaymentAccountsRequest;
use App\Containers\Vendor\Payment\UI\API\Requests\UpdatePaymentAccountRequest;
use App\Containers\Vendor\Payment\UI\API\Transformers\PaymentAccountTransformer;
use App\Ship\Parents\Controllers\ApiController;
use Illuminate\Http\JsonResponse;

class Controller extends ApiController
{
	public function getAllPaymentAccounts(GetAllPaymentAccountsRequest $request): array
	{
		$paymentAccounts = app(GetAllPaymentAccountsAction::class)->run();
		return $this->transform($paymentAccounts, PaymentAccountTransformer::class);
	}

	public function getPaymentAccount(FindPaymentAccountRequest $request): array
	{
		$paymentAccount = app(FindPaymentAccountDetailsAction::class)->run($request);
		return $this->transform($paymentAccount, PaymentAccountTransformer::class);
	}

	public function updatePaymentAccount(UpdatePaymentAccountRequest $request): array
	{
		$paymentAccount = app(UpdatePaymentAccountAction::class)->run($request);
		return $this->transform($paymentAccount, PaymentAccountTransformer::class);
	}

	public function deletePaymentAccount(DeletePaymentAccountRequest $request): JsonResponse
	{
		app(DeletePaymentAccountAction::class)->run($request);
		return $this->noContent();
	}
}
