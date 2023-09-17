<?php

namespace App\Http\Resources\users;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'phone' => $this->phone,
            'country_code' => $this->country_code,
            'newPhone' => $this->newPhone ?? '',
            'newCountryCode' => $this->newCountryCode ?? '',
            // 'currency' => $this->country->currency,
            'currency' => getSettingValue('currency'),
            'image' => $this->image,
            'language' => $this->language,
            'is_verified' => $this->is_verified
        ];
    }
}
