<?php

namespace App\Http\Requests\V1\Admin\Profile;

use App\Helpers\Helper;
use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\App;
use Illuminate\Validation\ValidationException;
class UserProfileRequest extends FormRequest
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
            'first_name' => 'required',
            'last_name' => 'required',
            'phone' => 'numeric|min:8'
        ];
    }

    public function messages()
    {
        return [
            'first_name.required' => 'Firstname is required!',
            'last_name.required' => 'Lastname is required!',
            'phone.numeric' => 'Phone number is invalid',
            'phone.digits' => 'Phone number minimum 8 digit',
        ];
    }

    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator){

        $response = response()->json(Helper::RETURN_ERROR_FORMAT(0, $validator->errors()->messages()));

        throw (new \Illuminate\Validation\ValidationException($validator, $response));
    }
}
