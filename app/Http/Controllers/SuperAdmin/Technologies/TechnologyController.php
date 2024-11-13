<?php

namespace App\Http\Controllers\SuperAdmin\Technologies;

use App\Http\Controllers\Controller;
use App\Http\Requests\SuperAdmin\Technologies\TechnologyRequest;
use App\Models\SuperAdmin\Technology;
use App\Http\Traits\Utils\UploadFileTrait;

class TechnologyController extends Controller
{
    use UploadFileTrait;
    protected $uploadPath = 'images/technologies';

    function __construct()
    {
        $this->middleware(['can:technologies-list'], ['only' => ['index', 'show']]);
        $this->middleware(['can:technologies-create'], ['only' => ['create', 'store']]);
        $this->middleware(['can:technologies-edit'], ['only' => ['edit', 'update']]);
        $this->middleware(['can:technologies-delete'], ['only' => ['destroy','trashedTechnologies','restore']]);
    }

    public function index()
    {
        $techs = Technology::all();
        return view('dashboard.technologies.index', compact('techs'));
    }

    public function create()
    {
        return view('dashboard.technologies.create');
    }

    public function store(TechnologyRequest $request)
    {
        $data = $request->validated();

        $data['image'] = $this->uploadFile($request->file('image'), $this->uploadPath);

        Technology::create($data);

        return redirect()->route('technologies.index')->with('success', 'Technology Created Successfully');
    }

    public function edit($id)
    {
        $tech = Technology::findOrFail($id);
        return view('dashboard.technologies.edit', compact('tech'));
    }
    public function update(TechnologyRequest $request, $id)
    {
        $data = $request->validated();

        $tech = Technology::findOrFail($id);

        $data['image'] = $request->file('image') ? $this->uploadFile($request->file('image'), $this->uploadPath) : $tech->image;

        $tech->update($data);

        return redirect()->route('technologies.edit', $id)->with('success', 'Technology Updated Successfully');

    }

    public function show($id)
    {
        $tech = Technology::findOrFail($id);
        return view('dashboard.technologies.show', compact('tech'));
    }

    public function destroy($id)
    {
        $tech = Technology::findOrFail($id);
        $tech->delete();

        return redirect()->route('technologies.index')->with('success', 'Technology Deleted Successfully');
    }
    public function trashedTechnologies()
    {
        $techs = Technology::onlyTrashed()->get();
        return view('dashboard.technologies.deleted', compact('techs'));
    }
    public function forceDelete($id)
    {
        Technology::withTrashed()->where('id', $id)->forceDelete();
        return redirect()->route('technologies.index')->with('success', 'Technology Permanently Deleted Successfully');
    }
    public function restore($id)
    {
        Technology::withTrashed()->where('id', $id)->restore();
        return redirect()->route('technologies.trashedTechnologies')->with('success', 'Technology Restored Successfully');
    }
}
