<?php

namespace Modules\Merchant\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use LangleyFoxall\LaravelNISTPasswordRules\PasswordRules;

class UpdateMerchantRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
{
    $merchantId = $this->route('merchant')->id ?? null;

    return [
        'company_name'        => ['required', 'string', 'max:191'],
        'mm_company_name'     => ['nullable', 'string', 'max:191'],
        'business_name'       => ['nullable', 'string', 'max:191'],
        'mm_business_name'    => ['nullable', 'string', 'max:191'],
        'business_email'     => [
            'required',
            'email',
            'max:191',
            'unique:merchants,business_email,' . $merchantId,

        ],
        'business_mobile'    => [
            'required',
            'string',
            'max:20',
            'valid_phone_number',
            'unique_merchant_phone_number:' . $merchantId,
        ],
        'address'             => ['nullable', 'string'],
        'registration_number' => ['required'],
    ];
}

public function messages()
{
    return [
        'valid_phone_number' => 'Invalid Mobile No. or Not Support Mobile No.',
        'roles.*.exists' => __('One or more roles were not found or are not allowed to be associated with this user type.'),
        'permissions.*.exists' => __('One or more permissions were not found or are not allowed to be associated with this user type.'),
    ];
}
}
