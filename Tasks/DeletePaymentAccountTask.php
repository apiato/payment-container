<?php

namespace App\Containers\Vendor\Payment\Tasks;

use App\Containers\Vendor\Payment\Data\Repositories\PaymentAccountRepository;
use App\Containers\Vendor\Payment\Models\PaymentAccount;
use App\Ship\Exceptions\DeleteResourceFailedException;
use App\Ship\Parents\Tasks\Task;
use Exception;

class DeletePaymentAccountTask extends Task
{
    protected PaymentAccountRepository $repository;

    public function __construct(PaymentAccountRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run(PaymentAccount $account): ?int
    {
        try {
            // first, get the associated account and remove this one!
            $account->accountable->delete();

            // then remove the payment account
            return $this->repository->delete($account->id);
        } catch (Exception $exception) {
            throw new DeleteResourceFailedException();
        }
    }
}
