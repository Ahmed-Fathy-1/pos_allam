<?php

namespace App\Http\Controllers\Api\SuperAdmin\AboutUs;

use App\Http\Controllers\Controller;
use App\Http\Helper\ResponseHelper;
use App\Http\Requests\SuperAdmin\AboutUs\AboutUsRequest;
use App\Http\Resources\Api\AboutUs\AboutUsResource;
use App\Http\Traits\Utils\UploadFileTrait;
use App\Models\SuperAdmin\AboutUs;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class AboutUsController extends Controller
{
    use UploadFileTrait;

    /**
     * Path for file uploads.
     *
     * @var string
     */
    protected $filePath = '/about_us';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        try {
            $aboutUs = AboutUs::firstOrFail();
            return ResponseHelper::sendResponseSuccess([
                'aboutUs' => new AboutUsResource($aboutUs),
            ]);
        } catch (ModelNotFoundException $e) {
            return ResponseHelper::sendResponseError('About Us page not found.', 404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param AboutUsRequest $request
     * @param string $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(AboutUsRequest $request, string $id)
    {
        try {
            $aboutUs = AboutUs::findOrFail($id);
            $data = $request->validated();

            // Array of image fields to handle
            $imageFields = [
                'workflow_download_image',
                'workflow_manage_image',
                'workflow_edit_image',
            ];

            // Process each image field
            foreach ($imageFields as $field) {
                if ($request->hasFile($field)) {
                    $data[$field] = $this->updateFile($request->file($field), $aboutUs->$field, $this->filePath);
                } else {
                    $data[$field] = $aboutUs->$field;
                }
            }

            $aboutUs->update($data);

            return ResponseHelper::sendResponseSuccess([
                'about_us' => new AboutUsResource($aboutUs),
            ]);

        } catch (ModelNotFoundException $e) {
            return ResponseHelper::sendResponseError('About Us page not found.', 404);
        }
    }
}