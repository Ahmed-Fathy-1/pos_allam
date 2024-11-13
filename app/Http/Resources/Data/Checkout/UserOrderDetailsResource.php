<?php

namespace App\Http\Resources\Data\Checkout;

use App\Http\Resources\Admin\Products\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserOrderDetailsResource extends JsonResource
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
            "product_id" => new ProductResource(Product::find($this->product_id)),
            "order_id" => $this->order_id,
            "quantity" => $this->quantity,
            "price" => $this->price,
            "discount" => $this->discount,
            "sub_total" => $this->sub_total
        ];
    }
}
