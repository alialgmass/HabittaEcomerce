<?php

namespace App\Http\Resources\countries;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CountryResource extends JsonResource
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
            'country_key' => $this->country_key,
            'country_code' => $this->country_code,
            'max_number' => $this->max_number,
            'currency' => $this->currency,
            'flag' => $this->flag,
        ];
    }
}
