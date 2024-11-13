<?php

namespace App\Http\Resources\Data\Products;

use App\Http\Resources\Admin\Products\ProductResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryWithProductsResource extends JsonResource
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
            "name" => $this->name,
            "description" =>$this->description,
            'image' => asset('storage/' .$this->image),
            'products' => ProductResource::collection($this->products)
        ];
    }
}
