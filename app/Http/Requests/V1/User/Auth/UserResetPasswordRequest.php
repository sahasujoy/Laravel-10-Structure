<?php

namespace App\Http\Requests\V1\User\Auth;

use App\Helpers\Helper;
use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\App;
use Illuminate\Validation\ValidationException;
class UserResetPasswordRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'new_password' => 'required|min:6',
            'confirm_password' => 'required|same:new_password'
        ];
    }

    public function messages()
    {
        return [
            'new_password.required' => 'New password is required!',
            'new_password.min' => 'New password minimum 6 character!',
            'confirm_password.required' => 'Confirm password is required!',
            'confirm_password.new_password' => 'Confirm password doesnt match ',
        ];
    }

}
