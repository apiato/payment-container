<?php

namespace App\Modules\Payment\Data\Repositories;

use App\Ship\Parents\Repositories\Repository;

/**
 * Class PaymentTransactionRepository
 */
class PaymentTransactionRepository extends Repository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id' => '=',
    ];
}
