<?php

namespace App\Containers\VendorSection\Payment\Exceptions;

use App\Ship\Parents\Exceptions\Exception;
use Symfony\Component\HttpFoundation\Response;

class NoChargeTaskForPaymentGatewayDefinedException extends Exception
{
    protected $code = Response::HTTP_INTERNAL_SERVER_ERROR;
    protected $message = 'No Charge Task for this Payment Gateway defined!';
}
