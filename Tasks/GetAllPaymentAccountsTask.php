<?php

namespace App\Containers\VendorSection\Payment\Tasks;

use App\Containers\VendorSection\Payment\Data\Repositories\PaymentAccountRepository;
use App\Containers\AppSection\User\Models\User;
use App\Ship\Criterias\OrderByCreationDateDescendingCriteria;
use App\Ship\Criterias\ThisUserCriteria;
use App\Ship\Parents\Tasks\Task;

class GetAllPaymentAccountsTask extends Task
{
    protected PaymentAccountRepository $repository;

    public function __construct(PaymentAccountRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run()
    {
        return $this->repository->paginate();
    }

    public function ordered(): PaymentAccountRepository
    {
        return $this->repository->pushCriteria(new OrderByCreationDateDescendingCriteria());
    }

    public function filterByUser(User $user): PaymentAccountRepository
    {
        return $this->repository->pushCriteria(new ThisUserCriteria($user->id));
    }
}
