<?php

namespace App\Http\Requests\admin\coupons;

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
            'code' => 'required',
            'percentage' => 'required_without:amount',
            'amount' => 'required_without:percentage',
            'max_date' => 'required',
            'max_clients' => 'required',
        ];
    }
}
