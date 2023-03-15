<?php

namespace App\Http\Requests\V1\Admin\Settings;

use App\Helpers\Helper;
use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\App;
use Illuminate\Validation\ValidationException;
class DefaultLimitSettingRequest extends FormRequest
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
            'apps_limit' => 'required|integer|min:1',
            'monthly_limit' => 'required|integer|min:1'
        ];
    }

    public function messages()
    {
        return [
            'apps_limit.required' => 'Apps limit is required!',
            'apps_limit.min' => 'Apps limit minimum value is 1',
            'apps_limit.max' => 'Apps limit maximum value is 100',
            'monthly_limit.required' => 'Monthly limit is required!',
            'monthly_limit.min' => 'Monthly limit minimum value is 1',
            'monthly_limit.max' => 'Monthly limit maximum value is 1000',
        ];
    }
}
