<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Vendor Section Payment Container
    |--------------------------------------------------------------------------
    */


    /*
     * The default currency if no currency is passed
     */
    'currency' => 'USD',

    'gateways' => [

        'stripe' => [
            'container'   => 'Stripe',
            'charge_task' => App\Containers\Vendor\Stripe\Tasks\ChargeWithStripeTask::class,
        ],

        'paypal' => [
            // ...
        ],

        // ...
    ],

];
