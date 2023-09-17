<?php

namespace App\Http\Requests\api\users;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'name' => ['required', 'string'],
            'phone' => ['required', 'string', 'unique:users,phone'],
            'password' => ['required', 'min:8'],
            'confirm_possword' => ['required', 'same:password', 'min:8'],
            'country_code' => ['required', 'string'],
            'email'      =>['nullable', 'string'],
        ];
    }
}
