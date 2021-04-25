<?php

/**
 * @apiGroup           Payment
 * @apiName            updatePaymentAccount
 *
 * @api                {PATCH} /v1/user/paymentaccounts/:id Update Payment Account
 * @apiDescription     Updates a single Payment Account. Does NOT (!) update the account credentials from the respective
 *                     payment gateway (e.g., Paypal).
 *
 * @apiVersion         1.0.0
 * @apiPermission      none
 *
 * @apiSuccessExample  {json}  Success-Response:
 * HTTP/1.1 200 OK
 * {
 * // ...
 * }
 */

use App\Containers\Vendor\Payment\UI\API\Controllers\Controller;
use Illuminate\Support\Facades\Route;

Route::patch('user/paymentaccounts/{id}', [Controller::class, 'updatePaymentAccount'])
    ->name('api_payment_update_payment_account')
    ->middleware(['auth:api']);
