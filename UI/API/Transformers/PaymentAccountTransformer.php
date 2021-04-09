<?php

namespace App\Containers\VendorSection\Payment\UI\API\Transformers;

use App\Containers\VendorSection\Payment\Models\PaymentAccount;
use App\Ship\Parents\Transformers\Transformer;

class PaymentAccountTransformer extends Transformer
{
    protected $defaultIncludes = [

    ];

    protected $availableIncludes = [

    ];

    public function transform(PaymentAccount $entity): array
    {
        $response = [

            'object' => 'PaymentAccount',
            'id' => $entity->getHashedKey(),

            'name' => $entity->name,

            'account' => [
                'type' => $entity->accountable->getPaymentGatewayReadableName(),
                'id' => $entity->accountable->getHashedKey(),
                'slug' => $entity->accountable->getPaymentGatewaySlug(),
            ],

            'details' => $entity->accountable->getDetailAttributes(),

            'created_at' => $entity->created_at,
            'updated_at' => $entity->updated_at,
            'readable_created_at' => $entity->created_at->diffForHumans(),
            'readable_updated_at' => $entity->updated_at->diffForHumans(),
        ];

        $response = $this->ifAdmin([
            'real_id' => $entity->id,
            'deleted_at' => $entity->deleted_at,
        ], $response);

        return $response;
    }
}
