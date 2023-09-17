<?php

namespace App\Http\Resources\home;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoriesResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $lang = $request->header('lang');
        return[
            'id' => $this->id,
            'name' => $this->name,
            'image' => $this->image,
        ];
    }
}
