<?php

namespace App\Http\Resources\Api\aboutUs;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AboutUsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // Prepare workflow data
        $workflows = [
            [
                'title' => $this->workflow_download_title,
                'description' => $this->workflow_download_desc,
                'number' => $this->workflow_download_number,
                'image' => $this->getImageUrl($this->workflow_download_image),
            ],
            [
                'title' => $this->workflow_manage_title,
                'description' => $this->workflow_manage_desc,
                'number' => $this->workflow_manage_number,
                'image' => $this->getImageUrl($this->workflow_manage_image),
            ],
            [
                'title' => $this->workflow_edit_title,
                'description' => $this->workflow_edit_desc,
                'number' => $this->workflow_edit_number,
                'image' => $this->getImageUrl($this->workflow_edit_image),
            ],
        ];

        return [
            'intro_title' => $this->intro_title,
            'intro_desc' => $this->intro_desc,
            'numbers' => [
                'clients' => [
                    'title' => $this->numbers_clients_title,
                    'count' => $this->numbers_clients_count,
                ],
                'downloads' => [
                    'title' => $this->numbers_downloads_title,
                    'count' => $this->numbers_downloads_count,
                ],
                'projects' => [
                    'title' => $this->numbers_projects_title,
                    'count' => $this->numbers_projects_count,
                ],
            ],
            'workflow' => [
                'title' => $this->workflow_title,
                'description' => $this->workflow_desc,
                'details' => $workflows,
            ],
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
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
        return $image ? asset("storage/uploads/about_us/{$image}") : null;
    }
}
