<?php

namespace App\Containers\VendorSection\Payment\Models;

use App\Ship\Parents\Models\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PaymentTransaction extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id',

        'gateway',
        'transaction_id',
        'status',
        'is_successful',

        'amount',
        'currency',

        'data',
        'custom',
    ];

    protected $attributes = [

    ];

    protected $hidden = [

    ];

    protected $casts = [
        'is_successful' => 'boolean',
        'data' => 'array',
        'custom' => 'array',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    /**
     * A resource key to be used by the the JSON API Serializer responses.
     */
    protected string $resourceKey = 'paymenttransactions';
}
