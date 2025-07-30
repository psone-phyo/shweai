<?php

namespace Modules\Merchant\Http\Requests;

use Illuminate\Validation\Rule;
use App\Domains\Auth\Models\User;
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
            'name'             => ['required', 'string', 'max:191'],
            'mm_name'          => ['nullable', 'string', 'max:191'],
            'business_name'    => ['nullable', 'string', 'max:191'],
            'mm_business_name' => ['nullable', 'string', 'max:191'],
            'bussiness_email'  => ['required', 'email', 'max:191', 'unique:merchants,bussiness_email'],
            'bussiness_mobile'  => ['required', 'string', 'max:20', 'valid_phone_number', 'unique:merchants,bussiness_mobile'],
            'address'          => ['nullable', 'string'],

            // 'type' => ['required', Rule::in([User::TYPE_ADMIN, User::TYPE_USER])],
            'name' => ['required', 'max:100'],
            'email' => ['required', 'max:255', 'email', Rule::unique('users')],
            'password' => ['max:100', PasswordRules::register($this->email)],
            'active' => ['sometimes', 'in:1'],
            'email_verified' => ['sometimes', 'in:1'],
            'send_confirmation_email' => ['sometimes', 'in:1'],
            'roles' => ['sometimes', 'array'],
            'roles.*' => [Rule::exists('roles', 'id')->where('type', $this->type)],
            'permissions' => ['sometimes', 'array'],
            'permissions.*' => [Rule::exists('permissions', 'id')->where('type', $this->type)],
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
