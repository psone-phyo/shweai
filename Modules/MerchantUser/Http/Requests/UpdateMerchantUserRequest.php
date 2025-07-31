<?php

namespace Modules\MerchantUser\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateMerchantUserRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $userId = optional($this->merchantuser->user)->id;

        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required', 'email', 'max:255',
                Rule::unique('users', 'email')->ignore($userId),
            ],
            'mobile' => [
                'required', 'max:20', 'valid_phone_number',
                'unique_user_phone_number:' . $userId,
            ],
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
        return auth()->user()->can('admin.access.merchantuser.edit');
    }
}
