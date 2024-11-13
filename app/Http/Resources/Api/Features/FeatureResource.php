<?php

namespace App\Http\Resources\Api\Features;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FeatureResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $features = [];
        $i = 1;

        // Loop through feature fields dynamically
        while ($this->{"feature_{$i}_title"} !== null) {
            $features[] = [
                "title" => $this->{"feature_{$i}_title"},
                "image" => $this->getImageUrl($this->{"feature_{$i}_image"}),
                "description" => $this->{"feature_{$i}_description"},
            ];
            $i++;
        }

        return [
            "main_title" => $this->main_title,
            "main_description" => $this->main_description,
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at,
            "features" => $features,
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
        return $image ? asset("storage/uploads/images/features/{$image}") : null;
    }
}
