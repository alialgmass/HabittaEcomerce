<?php

namespace App\Http\Requests\api\users;

use Illuminate\Foundation\Http\FormRequest;

class userAddressRequest extends FormRequest
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
            'title' => ['required', 'string'],
             'phone' =>  ['nullable', 'regex:/^([0-9\s\-\+\(\)]*)$/'],
             'country_code' => ['nullable', 'string'],
            'address' => ['required', 'string'],
            'is_default' => ['required', 'boolean'],
            'lat' => ['required', 'string'],
            'lng' => ['required', 'string'],
        ];
    }
}
