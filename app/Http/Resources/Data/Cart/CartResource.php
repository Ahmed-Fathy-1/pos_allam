<?php

namespace App\Http\Resources\Data\Cart;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CartResource extends JsonResource
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
            "user" => $this->user->name,
            "address_id" => $this->when($this->address_id != null,$this->address),
            "shipping_cost" =>$this->when($this->shipping_cost != null,$this->shipping_cost),
            "cart_details" => CartDetailsResource::collection($this->cartDetails),
            "total_quantity" => $this->cartDetails->sum('quantity'),
            "discount" => $this->cartDetails->sum('total_discount'),
            "subtotal_price" => $this->cartDetails->sum('sub_total'),
            "total_cost" => $this->total,
        ];
    }
}
