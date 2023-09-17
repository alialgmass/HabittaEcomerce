<?php

namespace App\Http\Resources\orders;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CouponResource extends JsonResource
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
            'code' => $this->code,
            'percentage' => (float)$this->percentage ?? 0,
            'amount' => (float)$this->amount ?? 0,
            'value' => $this->value(),
        ];
    }
}
