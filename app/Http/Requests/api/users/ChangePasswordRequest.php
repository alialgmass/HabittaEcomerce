<?php

namespace App\Http\Requests\api\users;

use Illuminate\Foundation\Http\FormRequest;

class ChangePasswordRequest extends FormRequest
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
            'country_code'=> ['required','exists:users,country_code'],
            'phone' => ['required','numeric','exists:users,phone'],
            'otp' => ['required', 'numeric'],
            'password' => ['required', 'min:8'],
            'confirm_possword' => ['required', 'same:password', 'min:8'],
        ];
    }
}
