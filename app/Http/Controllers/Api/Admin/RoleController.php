<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\RoleRequest;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::where('name','!=','super Admin')->get();
        $permission = Permission::get();
        return view('Admin.pages.role.index',compact('roles','permission'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(RoleRequest $request)
    {
        $role = Role::create(["name" => $request->name]);
        $role->syncPermissions($request->permission);
        return redirect()->back()->with('success','New Role Added');
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(RoleRequest $request, string $id)
    {
        $role = Role::findOrFail($id);
        $role->update(['name' => $request->name]);
        $adminGuardPermissions = Permission::whereIn('id', $request->permission)->get();
        $role->syncPermissions($adminGuardPermissions);
        return redirect()->back()->with('success','Role Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $role = Role::findById($id);
        $usersWithRole = $role->users()->count();
        if ($usersWithRole > 0)
            return redirect()->back()->with('warning', 'This Role Assign Before To Employee cannot Delete');
        else
            $role->delete();
        return redirect()->route('all-roles')
            ->with('success','Role deleted successfully');

    }
}
