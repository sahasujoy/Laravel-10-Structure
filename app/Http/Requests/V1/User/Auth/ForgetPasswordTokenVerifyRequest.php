<?php

namespace App\Http\Requests\V1\User\Auth;

use Illuminate\Foundation\Http\FormRequest;

class ForgetPasswordTokenVerifyRequest extends FormRequest
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
            'token_code' => 'required|min:6',
            'new_password' => 'required|required_with:password_confirmation|same:password_confirmation|min:6',
            'password_confirmation' => 'required|min:6',
        ];
    }

    public function messages()
    {
        return [
            'token_code.required' => 'Token is required!',
            'token_code.min' => 'Token min value is 6!',
        ];
    }
}
