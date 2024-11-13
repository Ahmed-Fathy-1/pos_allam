<?php

namespace App\Http\Controllers\SuperAdmin\Users;

use App\Models\SuperAdmin\User;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Traits\Utils\UploadFileTrait;

class UserController extends Controller
{
    use UploadFileTrait;

    function __construct()
    {
         $this->middleware(['can:User-list'], ['only' => ['index', 'show']]);
         $this->middleware(['can:User-create'], ['only' => ['create', 'store']]);
         $this->middleware(['can:User-edit'], ['only' => ['edit', 'update']]);
         $this->middleware(['can:User-delete'], ['only' => ['destroy','trashed','restore']]);
    }

    /**
     * @var string
     */
    protected $filePath = 'images/users';

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function index(Request $request)
    {
        $users = User::latest()->paginate(5);
        return view('dashboard.users.index',compact('users'));
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function create()
    {
        $roles = Role::pluck('name','name')->all();
        return view('dashboard.users.create',compact('roles'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password',
            "image"=> 'nullable|image|mimes:jpeg,png,jpg,svg,gif|max:2048',
            'roles' => 'required'
        ]);

        $input = $request->all();
        $input['password'] = Hash::make($input['password']);

        if (isset($input['image'])) {
            $input['image'] = $this->uploadFile($input['image'], $this->filePath);
        }
        $user = User::create($input);
        $user->assignRole($request->input('roles'));

        return redirect()->route('users.index')
                        ->with('success','User created successfully');
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function show($id)
    {
        $users = User::findOrFail($id);
        return view('dashboard.users.show',compact('users'));
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function edit($id)
    {
        $users = User::find($id);
        $roles = Role::pluck('name','name')->all();
        $userRole = $users->roles->pluck('name','name')->all();
        return view('dashboard.users.edit',compact('users','roles','userRole'));
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            'password' => 'same:confirm-password',
            "image"=> 'nullable|image|mimes:jpeg,png,jpg,,svg,gif|max:2048',
            'roles' => 'required'
        ]);

        $input = $request->all();
        if(!empty($input['password'])){
            $input['password'] = Hash::make($input['password']);
        }else{
            $input = Arr::except($input,array('password'));
        }

        $user = User::find($id);

        if (isset($input['image'])) {
            $input['image'] = $this->updateFile($input['image'], $user->image, $this->filePath);
        }

        $user->update($input);
        DB::table('model_has_roles')->where('model_id',$id)->delete();

        $user->assignRole($request->input('roles'));

        return redirect()->route('users.index')
                        ->with('success','User updated successfully');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        User::find($id)->delete();
        return redirect()->route('users.index')
                        ->with('success','User deleted successfully');
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function trashed()
    {
        $users = User::onlyTrashed()->paginate(10);
        return view('dashboard.users.delete', compact('users'));
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    // Restore a soft-deleted user
    public function restore($id)
    {
        $user = User::withTrashed()->findOrFail($id);
        $user->restore();
        return redirect()->route('users.trashed')->with('success', 'User restored successfully.');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    // Permanently delete a user
    public function forceDelete($id)
    {
        $user = User::withTrashed()->findOrFail($id);
        $user->forceDelete();
        return redirect()->route('users.trashed')->with('success', 'User permanently deleted.');
    }
}
