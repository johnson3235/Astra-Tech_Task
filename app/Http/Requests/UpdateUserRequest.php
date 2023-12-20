<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
            'email' => ['required', 'email',Rule::unique('user_data')->ignore(request()->route('id'))],
            'phone_number' => ['required', 'regex:/^(\+20|0)?1[0125]\d{8}$/',Rule::unique('user_data')->ignore(request()->route('id')),],

    
        ];
    }
}
