<?php

namespace App\Http\Requests\api\users;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class updatePhoneRequest extends FormRequest
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
            'phone' => ['required', 'regex:/^([0-9\s\-\+\(\)]*)$/',Rule::unique('users')->ignore(auth()->id())],
            'country_code' => ['required', 'string', 'max:5'],
        ];
    }
}
