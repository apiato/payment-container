<?php

namespace App\Containers\VendorSection\Payment\UI\API\Requests;

use App\Ship\Parents\Requests\Request;

class UpdatePaymentAccountRequest extends Request
{
    /**
     * Define which Roles and/or Permissions has access to this request.
     */
    protected array $access = [
        'permissions' => '',
        'roles' => '',
    ];

    /**
     * Id's that needs decoding before applying the validation rules.
     */
    protected array $decode = [
        'id',
    ];

    /**
     * Defining the URL parameters (e.g, `/user/{id}`) allows applying
     * validation rules on them and allows accessing them like request data.
     */
    protected array $urlParameters = [
        'id',
    ];

    public function rules(): array
    {
        return [
            'id' => 'required|exists:payment_accounts,id',
            'name' => 'sometimes|string|max:190',
        ];
    }

    public function authorize(): bool
    {
        return $this->check([
            'hasAccess',
        ]);
    }
}
