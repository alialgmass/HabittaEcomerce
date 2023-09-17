<?php

namespace App\Http\Resources\product;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ReviewsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => (int)$this->id,
            'comment' => $this->comment,
            'rating' => (float)$this->rating,
            'user' => $this->user_name,
            'image' => $this->user_image ?
                asset('uploads/users/' . $this->user_id . '/' . $this->user_image) :
                asset('AdminAssets/app-assets/images/portrait/small/avatar.png'),
            'created_at' => Carbon::parse($this->created_at)->format('M d, Y'),
        ];
    }
}
