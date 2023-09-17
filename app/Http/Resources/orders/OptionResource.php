<?php

namespace App\Http\Resources\orders;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OptionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $lang = $request->header('Accept-Language');
        return [
            'id' => $this->optionable->id,
            'name' => $this->optionable['name_' . $lang],
            'image' => $this->optionable->image,
            'price' => (float)$this->price,
            'quantity' => (integer)$this->quantity,
            'total' => (float)$this->total,
        ];
    }
}
