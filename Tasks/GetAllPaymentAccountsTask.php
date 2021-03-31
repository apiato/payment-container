<?php

namespace App\Modules\Payment\Tasks;

use App\Modules\Payment\Data\Repositories\PaymentAccountRepository;
use App\Containers\User\Models\User;
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
