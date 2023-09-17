<?php

namespace App\Http\Requests\api\users;

use Illuminate\Foundation\Http\FormRequest;

class checkOtpRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        $type = $this->input('type');

        $rules = [
            'type' => ['required', 'in:register,forget,update'],
            'otp' => ['required', 'numeric'],
            'device_token' => 'required'
        ];

        if($type == "update")
        {
           $rules["phone"] = ['required', 'exists:users,newPhone', 'regex:/^([0-9\s\-\+\(\)]*)$/'];
           $rules["country_code"] = ['required', 'exists:users,newCountryCode', 'regex:/^([0-9\s\-\+\(\)]*)$/'];
        }
        else
        {
            $rules["phone"] = ['required', 'exists:users,phone', 'regex:/^([0-9\s\-\+\(\)]*)$/'];
            $rules["country_code"] = ['required', 'exists:users,country_code', 'regex:/^([0-9\s\-\+\(\)]*)$/'];
        }

        return $rules;
    }
}
