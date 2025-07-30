<?php

namespace Modules\Merchant\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
            'name'             => ['required', 'string', 'max:191'],
            'mm_name'          => ['nullable', 'string', 'max:191'],
            'business_name'    => ['nullable', 'string', 'max:191'],
            'mm_business_name' => ['nullable', 'string', 'max:191'],
            'email'            => ['required', 'email', 'max:191', 'unique:merchants,email'],
            'phone'            => ['required', 'string', 'max:20', 'valid_phone_number'],
            'address'          => ['nullable', 'string'],
        ];
    }

    public function messages()
    {
        return [
            'valid_phone_number' => 'Invalid Mobile No. or Not Support Mobile No.',
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
