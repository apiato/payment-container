<?php

namespace App\Containers\Vendor\Payment\Tasks;

use App\Containers\Vendor\Payment\Exceptions\PaymentAccountDoesNotBelongToUserException;
use App\Containers\Vendor\Payment\Models\PaymentAccount;
use App\Containers\AppSection\User\Models\User;
use App\Ship\Parents\Tasks\Task;

class CheckIfPaymentAccountBelongsToUserTask extends Task
{
    public function run(User $user, PaymentAccount $account): bool
    {
        if ($user->id !== $account->user_id) {
            throw new PaymentAccountDoesNotBelongToUserException();
        }

        return true;
    }
}
