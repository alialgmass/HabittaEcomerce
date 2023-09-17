<?php

namespace App\Http\Requests\api\users;

use Illuminate\Foundation\Http\FormRequest;

class checkPhoneRequest extends FormRequest
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
        return [
            'phone' => ['required', 'exists:users,phone', 'regex:/^([0-9\s\-\+\(\)]*)$/'],
            'country_code' => ['required', 'exists:countries,country_code', 'regex:/^([0-9\s\-\+\(\)]*)$/'],
        ];
    }
}
