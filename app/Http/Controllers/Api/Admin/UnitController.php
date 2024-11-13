<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UnitRequest;
use App\Models\Unit;
use App\Models\UnitLogs;
use App\services\logs\unitlogsServices;
use Illuminate\Http\Request;

class UnitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $units = Unit::all();
        return view('Admin.pages.unit.index',compact('units'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UnitRequest $request)
    {
        Unit::create($request->validated()+['user_id' => auth()->user()->id]);
        return redirect()->back()->with('success','Unit Created Successfully');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UnitRequest $request, string $id , unitlogsServices $service)
    {
        $validated = $request->validated();
        $unit = Unit::findOrFail($id);
        $unit->update($validated);
        if($unit->unitPrice->count() > 0){
            $unit->unitPrice()->update(['status' => $validated['status']]);
        }

        return redirect()->back()->with('success','Unit Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id,unitlogsServices $service)
    {
        $unit = Unit::findOrFail($id);
        if($unit->unitPrice->count() > 0){
            return redirect()->back()->withErrors('cannot Delete Unit That related to Many Products ');
        }
        $unit->delete();
        return redirect()->back()->with('success','Unit Deleted Successfully');
    }
}
