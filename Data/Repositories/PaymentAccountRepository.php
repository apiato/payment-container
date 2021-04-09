<?php

namespace App\Containers\VendorSection\Payment\Data\Repositories;

use App\Ship\Parents\Repositories\Repository;

/**
 * Class PaymentAccountRepository
 */
class PaymentAccountRepository extends Repository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id'    => '=',
        'name'  => 'like',
    ];
}
