<?php

namespace App\Http\Resources\Data\Meta;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MetaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "title" => $this->title,
            "canonical_url" => $this->canonical_url,
            "keyword" => $this->keyword,
            "description" => $this->description,
            "schema_markup" => $this->schema_markup,
            "product_id" => $this->when($this->product_id !=null,$this->product_id),
            "category_id" => $this->when($this->category_id !=null,$this->category_id),
        ];
    }
}
