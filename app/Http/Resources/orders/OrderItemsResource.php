<?php

namespace App\Http\Resources\orders;

use App\Http\Resources\orders\OptionResource;
use App\Models\products\Size;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderItemsResource extends JsonResource
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
            'product_id' => (int)$this->product_id,
            'name' => $this->product->name,
            'description' => $this->product->description,
            'image' => $this->product->image,
            'images' => $this->product->additionalImages,
            'quantity' => $this->quantity,
            'price' => (float)$this->price,
            'total' => (float)$this->total,
            'addons' => OptionResource::collection($this->options->where('optionable_type', 'App\Models\products\Addon')),
            'snacks' => OptionResource::collection($this->options->where('optionable_type', 'App\Models\products\Snack')),
            'ingredients' => OptionResource::collection($this->options->where('optionable_type', 'App\Models\products\Ingredient')),
            'sizes' => OptionResource::collection($this->options->where('optionable_type', 'App\Models\products\Size')),
        ];
    }
}
