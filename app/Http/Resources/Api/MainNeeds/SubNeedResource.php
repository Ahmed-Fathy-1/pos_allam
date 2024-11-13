<?php

namespace App\Http\Resources\Api\MainNeeds;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SubNeedResource extends JsonResource
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
            "desc" => $this->desc,
            "image" => $this->getImageUrl($this->image),
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at,
        ];
    }

    /**
     * Get the full URL of the image.
     *
     * @param string|null $image
     * @return string|null
     */
    private function getImageUrl(?string $image): ?string
    {
        return $image ? asset("storage/uploads/images/needs/{$image}") : null;
    }
}
