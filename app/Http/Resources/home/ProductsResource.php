<?php

namespace App\Http\Resources\home;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductsResource extends JsonResource
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
            'description' => (string) $this->description,
            'price' => (float) $this->price,
            'currency' => getSettingValue('currency'),
            'discount' => (float) $this->discount,
            'favourite' => $this->inWishlist($this->id),
            'hasOffer' => (bool) $this->hasOffer(),
            'offer' => [
                'percentage' => (float) $this->offer['percentage'],
                'priceAfterDiscount' => (float) $this->offer['priceAfterDiscount'],
                'remainingDays' => (float) $this->offer['remainingDays'],
            ],
            'category'=>[
             'name'=>$this->category->name
            ],
            'rating' => [
                'rate' => $this->reviews->avg('rating') ?? 0,
                'count' => $this->reviews->count(),
            ],
            'image' => $this->image,
        ];
    }
}
