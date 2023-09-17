<?php

namespace App\Http\Requests\admin\restaurants;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            'name_ar' => 'required|string|max:255',
            'name_en' => 'required|string|max:255',
            'description_ar'=>'required|string',
            'description_en'=>'required|string',
            'logo'=> 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'cover'=> 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'phone'=>'required|numeric',
            'whatsapp'=>'required',
            'address'=>'required|string',
            'latitude'=>'required',
            'longitude'=>'required',
            'delivery_time'=>'required',
            'delivery_fees'=>'required|numeric',
            'day.*'=>'required',
            'start_hour.*'=>'required',
            'end_hour.*'=>'required'
        ];
    }
}
