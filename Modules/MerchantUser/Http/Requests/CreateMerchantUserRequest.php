<?php

namespace Modules\MerchantUser\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use LangleyFoxall\LaravelNISTPasswordRules\PasswordRules;

class CreateMerchantUserRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nrc'   => "required",
            'name' => ['required', 'max:100'],
            'email' => ['required', 'max:255', 'email', Rule::unique('users', 'email')],
            'mobile' => ['required', 'max:20', 'valid_phone_number', 'unique_user_phone_number'],
        ];
    }

    public function mesages(){
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
        return auth()->user()->can('admin.access.merchantuser.create');
    }
}
