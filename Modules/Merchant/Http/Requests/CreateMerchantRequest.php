<?php

namespace Modules\Merchant\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use LangleyFoxall\LaravelNISTPasswordRules\PasswordRules;

class CreateMerchantRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'company_name'             => ['required', 'string', 'max:191'],
            'mm_company_name'          => ['nullable', 'string', 'max:191'],
            'business_name'    => ['nullable', 'string', 'max:191'],
            'mm_business_name' => ['nullable', 'string', 'max:191'],
            'business_email'  => ['required', 'email', 'max:191', 'unique:merchants,business_email'],
            'business_mobile'  => ['required', 'string', 'max:20', 'valid_phone_number', 'unique_merchant_phone_number'],
            'address'          => ['nullable', 'string'],
            'registration_number'          => ['required'],
            'nrc'   => "required",

            'name' => ['required', 'max:100'],
            'email' => ['required', 'max:255', 'email', 'unique:users,email'],
            'mobile' => ['required', 'max:20', 'valid_phone_number', 'unique_user_phone_number'],
            'password' => ['max:100', PasswordRules::register($this->email)],
        ];
    }

    public function messages()
    {
        return [
            'business_mobile.valid_phone_number' => 'Invalid Business Mobile No. or Not Support Business Mobile No.',
            'mobile.valid_phone_number' => 'Invalid Mobile No. or Not Support Mobile No.',
            'roles.*.exists' => __('One or more roles were not found or are not allowed to be associated with this user type.'),
            'permissions.*.exists' => __('One or more permissions were not found or are not allowed to be associated with this user type.'),
        ];
    }
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user()->can('admin.access.merchant.create');
    }
}
