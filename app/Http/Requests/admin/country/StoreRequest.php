<?php

namespace App\Http\Requests\admin\country;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'name_ar' => 'required|string|max:255|unique:countries,name_ar',
            'name_en' => 'required|string|max:255|unique:countries,name_en',
            'country_key' => 'required|string|unique:countries,country_key',
            'country_code' => 'required|string|max:255|unique:countries,country_code',
            'max_number' => 'required|string|max:255',
            'flag' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',

        ];
    }
}
