<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\EmployeeRequest;
use App\Http\Requests\Admin\EmployeeUpdateRequest;
use App\Models\User;
use App\services\employeeService;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employees = User::whereNotNull('role_name')->where('id','!=',auth()->user()->id)
                            ->where('role_name','!=','Super Admin')->latest('id')->get();
        $roles = Role::where('name','!=','Super Admin')->get();
        return view('Admin.pages.employee.index',compact('employees','roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::where('name','!=','Super Admin')->get();
        return view('Admin.pages.employee.create',compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EmployeeRequest $request,employeeService $service)
    {
        $validated = $request->validated();
        if ($request->hasFile('image')){
            $image = $request->image;
            $filename = $service->image($image);
        }
        $user = User::create(Arr::except($validated,['image']) + ['image' => $filename??null]);
        $user->assignRole($request->role_name);
        return redirect()->route('employee.index')->with('success','employee Added Successfully');
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(EmployeeUpdateRequest $request, string $id,employeeService $service)
    {
        $user = User::findOrFail($id);
        $validated = $request->validated();
        if ($request->hasFile('image')){
            $oldFilePath = asset('storage/employee/'.$user->image);
            if (file_exists($oldFilePath)) {
                unlink($oldFilePath);
            }
            $image = $request->image;
            $filename = $service->image($image);
            $user->update(['image' => $filename]);
        }
        if (isset($validatedData['password'])) {
            $user->password = bcrypt($validatedData['password']);
        }
       $user->name = $validated['name'];
         $user->mobile = $validated['mobile'];
        $user->email = $validated['email'];
        $user->role_name = $validated['role_name'];
        $user->save();
        DB::table('model_has_roles')->where('model_id',$request->id)->delete();
        $user->assignRole($request->role_name);
        return redirect()->route('employee.index')->with('success','employee Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        $oldFilePath = asset('storage/employee/'.$user->image);
        if (file_exists($oldFilePath)) {
            unlink($oldFilePath);
        }
        $user->delete();
        return redirect()->route('employee.index')->with('success','employee Deleted Successfully');
    }
}
