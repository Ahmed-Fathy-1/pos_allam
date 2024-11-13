<?php

namespace App\Http\Resources\Data\Checkout;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CouponResorce extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "code" => $this->code,
            "limit" => $this->limit,
            "discount" => $this->discount,
            "start_at" => $this->start_at,
            "end_at" => $this->end_at,
            "created_by" => $this->user
        ];
    }
}
