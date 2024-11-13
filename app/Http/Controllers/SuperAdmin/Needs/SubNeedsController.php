<?php

namespace App\Http\Controllers\SuperAdmin\Needs;

use App\Http\Controllers\Controller;
use App\Http\Traits\Utils\UploadFileTrait;
use App\Models\SuperAdmin\Needes\MainNeed;
use App\Models\SuperAdmin\Needes\SubNeeds;
use App\Models\SuperAdmin\PaymentMethod;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;

class SubNeedsController extends Controller
{

    use UploadFileTrait,SoftDeletes;

    protected $filePath = 'images/needs';

    function __construct()
    {
        $this->middleware(['can:subNeeds-list'], ['only' => ['index']]);
        $this->middleware(['can:subNeeds-create'], ['only' => ['create', 'store']]);
        $this->middleware(['can:subNeeds-edit'], ['only' => ['edit', 'update']]);
        $this->middleware(['can:subNeeds-delete'], ['only' => ['destroy','showDeleted','forceDelete','restore']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subNeeds = SubNeeds::paginate(10);
        return view('dashboard.Needs.sub_needs.sub_needs')->with('subNeeds', $subNeeds);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.Needs.sub_needs.create');
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

        SubNeeds::create($data);

        return to_route('sub_needs.index')->with('success', 'Sub need created successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $subNeeds = SubNeeds::findOrFail($id);
        return view('dashboard.Needs.sub_needs.edit', compact('subNeeds'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request , $id)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'desc' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]) + ['main_need_id' => MainNeed::findOrFail(1)->id];

        $subNeeds = SubNeeds::findOrFail($id);

        if ($request->hasFile('image')) {
            $data['image'] = $this->updateFile($request->file('image'), $subNeeds->image, $this->filePath);
        };

        $subNeeds->update($data);

        return to_route('sub_needs.index')->with('success', 'Sub need updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $subNeeds = SubNeeds::withTrashed()->findOrFail($id);
        $subNeeds->delete();
        return to_route('sub_needs.index')->with('success', 'Sub need deleted successfully!');
    }

    public function showDeleted()
    {
        $subNeeds = SubNeeds::onlyTrashed()->get();
        return view('dashboard.Needs.sub_needs.deleted', compact('subNeeds'));
    }

    public function forceDelete($id)
    {
        SubNeeds::withTrashed()->where('id', $id)->forceDelete();
        return redirect()->route('sub_needs.deleted')->with('success', 'User Need Permanently Deleted Successfully');
    }

    public function restore($id)
    {
        SubNeeds::withTrashed()->where('id', $id)->restore();
        return redirect()->route('sub_needs.index')->with('success', 'Need Restored Successfully');
    }
}
