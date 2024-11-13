<?php

namespace App\Http\Controllers\Api\SuperAdmin\Needs;

use App\Http\Controllers\Controller;
use App\Http\Helper\ResponseHelper;
use App\Http\Resources\Api\MainNeeds\SubNeedResource;
use App\Http\Traits\Utils\UploadFileTrait;
use App\Models\SuperAdmin\Needes\MainNeed;
use App\Models\SuperAdmin\Needes\SubNeeds;
use Illuminate\Http\Request;

class SubNeedsController extends Controller
{

    use UploadFileTrait;

    protected $filePath = 'images/needs';

    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subNeeds = SubNeeds::paginate(10);

        return ResponseHelper::sendResponseSuccess([
            'sub_needs' => SubNeedResource::collection($subNeeds),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
                'title' => 'required|string|max:255',
                'desc' => 'required|string',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]) + ['main_need_id' => MainNeed::findOrFail(1)->id];

        $data['image'] = $request->file('image')
            ? $this->uploadFile($request->file('image'), $this->filePath)
            : null;

        $subNeeds =SubNeeds::create($data);
        return ResponseHelper::sendResponseSuccess([
            'user_need' => new SubNeedResource($subNeeds),
        ]);


    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validate request data
        $data = $request->validate([
                'title' => 'required|string|max:255',
                'desc' => 'required|string',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]) + ['main_need_id' => MainNeed::findOrFail(1)->id];

        // Find the SubNeed by ID or fail
        $subNeeds = SubNeeds::findOrFail($id);

        // Handle the image update if a new file is uploaded
        if ($request->hasFile('image')) {
            $data['image'] = $this->updateFile($request->file('image'), $subNeeds->image, $this->filePath);
        }

        // Update the SubNeed with new data
        $subNeeds->update($data);

        // Return a success response with the updated resource
        return ResponseHelper::sendResponseSuccess([
            'user_need' => new SubNeedResource($subNeeds),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Find the SubNeed by ID or fail
        $subNeed = SubNeeds::findOrFail($id);

        // Delete the SubNeed
        $subNeed->delete();

        // Return a success response
        return ResponseHelper::sendResponseSuccess(
            "Deleted successfully"
        );
    }



}
