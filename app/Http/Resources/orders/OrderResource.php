<?php

namespace App\Http\Resources\orders;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
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
            'id' => $this->id,
            'order_number' => $this->order_number,
           // 'status' => $this->status,
            'user' => $this->user->name,
            'total' => (float)$this->total,
            'ProductsNames' => $this->ProductsNames($lang),
            'images' => $this->images,
            'created' => $this->created_at,
        ];
    }
}
