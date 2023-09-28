<?php

namespace App\Http\Resources\users;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AddressesResource extends JsonResource
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
            'user' => $this->user->name,
            'title' => $this->title,
            'phone' => $this->user->phone,
            'country_code' => $this->user->country_code,
            'lat' => (float)$this->lat,
            'lng' => (float)$this->lng,
            'address' => $this->address,
            'default' => (int)$this->is_default,
        ];
    }
}
