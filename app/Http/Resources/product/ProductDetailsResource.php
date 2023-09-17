<?php

namespace App\Http\Resources\product;

use App\Http\Resources\product\AddonResource;
use App\Http\Resources\product\IngredientResource;
use App\Http\Resources\product\SizeResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductDetailsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return[
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'full_description'=>$this->fullDescription,
            'image' => $this->image,
            'images' => $this->additionalImages,
            'price' => (float)$this->price,
            'discount' => (float)$this->discount,
            'currency' => getSettingValue('currency'),
            'vat' => (float)getSettingValue('vat'),
            'favourite' => $this->inWishlist($this->id),
            'hasOffer' => (bool) $this->hasOffer(),
            'offer' => [
                'percentage' => (float) $this->offer['percentage'],
                'priceAfterDiscount' => (float) $this->offer['priceAfterDiscount'],
                'remainingDays' => (float) $this->offer['remainingDays'],
            ],
            'rating' => [
                'rate' => $this->reviews->avg('rating'),
                'count' =>  $this->reviews->count(),
            ],
            'product_futuer'=>$this->Productfutuer,

        ];
    }
}
