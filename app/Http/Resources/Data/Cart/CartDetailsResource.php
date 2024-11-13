<?php

namespace App\Http\Resources\Data\Cart;

use App\Http\Resources\Admin\Products\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CartDetailsResource extends JsonResource
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
            'cart_id' => $this->cart,
            "unit_id" =>$this->unit_id,
            "product_id" => new ProductResource(Product::find($this->product_id)),
            "quantity" => $this->quantity,
            'gst'  => $this->gst,
            "price" => $this->price,
            "price_after_discount" => $this->price_after_discount,
            "total_discount" => $this->total_discount,
            'sub_total' => $this->sub_total,
            'total' => $this->total
        ];
    }
}
