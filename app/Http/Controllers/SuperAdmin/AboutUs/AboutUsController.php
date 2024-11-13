<?php

namespace App\Http\Controllers\SuperAdmin\AboutUs;

use App\Http\Controllers\Controller;
use App\Http\Requests\SuperAdmin\AboutUs\AboutUsRequest;
use App\Http\Traits\Utils\UploadFileTrait;
use App\Models\SuperAdmin\AboutUs;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class AboutUsController extends Controller
{
    use UploadFileTrait;

    protected $filePath = '/about_us';

    function __construct()
    {
        $this->middleware(['can:aboutUs-edit'], ['only' => ['edit', 'update']]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param string $id
     * @return View
     */
    public function edit(string $id): View
    {
        try {
            $aboutUs = AboutUs::findOrFail($id);
            return view('dashboard.about_us.edit', compact('aboutUs'));
        } catch (ModelNotFoundException $e) {
            abort(404, 'About Us page not found.');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param AboutUsRequest $request
     * @param string $id
     * @return RedirectResponse
     */
    public function update(AboutUsRequest $request, string $id): RedirectResponse
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
            return redirect()->back()->with('success', 'About Us updated successfully.');

        } catch (ModelNotFoundException $e) {
            abort(404, 'About Us page not found.');
        }
    }
}
