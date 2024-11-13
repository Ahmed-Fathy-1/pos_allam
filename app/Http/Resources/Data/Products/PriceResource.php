<?php

namespace App\Http\Resources\Data\Products;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PriceResource extends JsonResource
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
            'product_id' => $this->product_id,
            "unit" => $this->unit->name,
            "unit_id" => $this->unit_id,
            "price" => $this->price - $this->gst,
            "discount" => $this->discount
        ];
    }
}
