<?php

namespace App\Http\Resources\Data\Fav;

use App\Http\Resources\Admin\Products\ProductResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FaveResource extends JsonResource
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
            "user_id" => $this->user,
            "product" => new ProductResource($this->product)
        ];
    }
}
