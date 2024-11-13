<?php

namespace App\Http\Controllers\SuperAdmin\Roles;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{

    function __construct()
    {
         $this->middleware(['can:Role-list'], ['only' => ['index', 'show']]);
         $this->middleware(['can:Role-create'], ['only' => ['create', 'store']]);
         $this->middleware(['can:Role-edit'], ['only' => ['edit', 'update']]);
         $this->middleware(['can:Role-delete'], ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        $roles = Role::orderBy('id', 'DESC')->paginate(5);
        return view('dashboard.roles.index', compact('roles'));
    }

    public function create()
    {
        $permission = Permission::get();
        return view('dashboard.roles.create', compact('permission'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:roles,name',
            'permission' => 'required',
        ]);

        $role = Role::create(['name' => $request->input('name')]);
        $permissions = Permission::whereIn('id', $request->input('permission'))->get();

        $role->syncPermissions($permissions);

        return redirect()->route('roles.index')
            ->with('success', 'Role created successfully');
    }

    public function show($id)
    {
        $role = Role::find($id);
        $rolePermissions = Permission::join("role_has_permissions", "role_has_permissions.permission_id", "=", "permissions.id")
            ->where("role_has_permissions.role_id", $id)
            ->get();

        return view('dashboard.roles.show', compact('role', 'rolePermissions'));
    }

    public function edit($id)
    {
        $roles = Role::find($id);
        $permission = Permission::get();
        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id", $id)
            ->pluck('role_has_permissions.permission_id', 'role_has_permissions.permission_id')
            ->all();

        return view('dashboard.roles.edit', compact('roles', 'permission', 'rolePermissions'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'permission' => 'required',
        ]);

        $role = Role::find($id);
        $role->name = $request->input('name');
        $role->save();
        $permissions = Permission::whereIn('id', $request->input('permission'))->get();
        $role->syncPermissions($permissions);

        return redirect()->route('roles.index')
            ->with('success', 'Role updated successfully');
    }

    public function destroy($id)
    {
        DB::table("roles")->where('id', $id)->delete();
        return redirect()->route('roles.index')
            ->with('success', 'Role deleted successfully');
    }
}
