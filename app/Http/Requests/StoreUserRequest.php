<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'first_name' => ['required', 'string', 'between:3,255'],
            'last_name' => ['required', 'string', 'between:3,255'],
            'email' => ['required', 'email','unique:user_data,email'],
            'phone' => ['required', 'regex:/^(\+20|0)?1[0125]\d{8}$/','unique:user_data,phone_number'],
        ];
    }
}
