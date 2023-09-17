<?php

namespace App\Http\Requests\admin\products;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
            'name_ar' => ['required', 'string', 'max:255'],
            'name_en' => ['required', 'string', 'max:255'],
            'description_ar' => ['required', 'string'],
            'description_en' => ['required', 'string'],
            'full_description_ar' => ['required', 'string'],
            'full_description_en' => ['required', 'string'],
            'price' => ['required', 'numeric', 'min:0'],
            'quantity'=> ['required', 'numeric', 'min:0'],
            'discount' => ['nullable', 'numeric', 'max:100', 'min:0'],
            'ordering'=> ['nullable', 'numeric',  'min:0'],
            'active' => ['required', 'in:0, 1'],
            'image' => ['required', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
            'category_id' => ['required', 'exists:categories,id'],
        ];
    }
}
