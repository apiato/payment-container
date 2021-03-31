<?php

namespace App\Modules\Payment\Tasks;

use App\Modules\Payment\Data\Repositories\PaymentAccountRepository;
use App\Modules\Payment\Models\PaymentAccount;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Tasks\Task;
use Exception;

class FindPaymentAccountByIdTask extends Task
{
    protected PaymentAccountRepository $repository;

    public function __construct(PaymentAccountRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run($id): PaymentAccount
    {
        try {
            $paymentAccount = $this->repository->find($id);
        } catch (Exception $exception) {
            throw new NotFoundException();
        }

        return $paymentAccount;
    }
}
