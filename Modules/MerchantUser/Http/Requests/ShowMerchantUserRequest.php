<?php

namespace Modules\MerchantUser\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ShowMerchantUserRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user()->can('admin.access.merchantuser.view');
    }
}
