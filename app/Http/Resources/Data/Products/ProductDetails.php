<?php

namespace App\Http\Resources\Data\Products;

use App\Http\Resources\Admin\Category\Categoryresource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductDetails extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "category" => new Categoryresource($this->id)
        ];
    }
}
