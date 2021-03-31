<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Payment Container
    |--------------------------------------------------------------------------
    */


    /*
     * The default currency if no currency is passed
     */
    'currency' => 'USD',

    'gateways' => [

        'stripe' => [
            'container'   => 'Stripe',
            'charge_task' => App\Modules\Stripe\Tasks\ChargeWithStripeTask::class,
        ],

        'paypal' => [
            // ...
        ],

        // ...
    ],

];
