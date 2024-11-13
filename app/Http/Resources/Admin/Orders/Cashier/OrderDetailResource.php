<?php

namespace App\Http\Resources\Admin\Orders\Cashier;

use App\Http\Resources\Admin\Products\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderDetailResource extends JsonResource
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
            "product" => new ProductResource(Product::find($this->product_id)),
            "quantity" => $this->quantity,
            "price" => $this->price,
            "discount" => $this->discount,
        ];
    }
}
