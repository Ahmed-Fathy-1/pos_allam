<?php

namespace App\Http\Controllers\SuperAdmin\Domains;

use App\Http\Traits\Utils\UploadFileTrait;
use App\Models\Tenant;
use Illuminate\Http\Request;
use App\Models\SuperAdmin\User;
use App\Mail\TenantRegisterMail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class TenantController extends Controller
{
    use UploadFileTrait;

    protected $filePath = 'images/users';

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tenants = Tenant::paginate(10);
        return view('dashboard.tenants.index', compact('tenants'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.tenants.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    // public function store(Request $request)
    // {
    //     $this->validate($request, [
    //         'name' => 'required|string|max:255',
    //         'email' => 'required|string|email|max:50',
    //         'password' => 'required|string|min:8',
    //         'phone' => 'required|string|max:20',
    //         'tenant' => 'required|string|max:255',
    //         'image' =>'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    //     ]);

    //     $user = User::create([
    //         'name' => $request->name,
    //         'email' => $request->email,
    //         'password' => $request->password,
    //         'phone' => $request->phone,
    //         'image' => isset($request->image) ? $request->image : null,
    //     ]);

    //     if ($request->hasFile('image')) {
    //         $this->uploadFile($request->file('image'), $this->filePath);
    //     }

    //     $user->assignRole('Super Admin');

    //     $tenant = Tenant::create([
    //         'id' => $request->tenant,
    //         'name' => $request->tenant,
    //         'user_id' => $user->id,
    //     ]);

    //     $tenant->domains()->create([
    //         'domain' => $request->tenant,
    //     ]);

    //     try {
    //         $name = $request->name;
    //         $email = $request->email;
    //         $password = $request->password;
    //         $messageSuperAdmin = 'Create New customer';
    //         $messageAdmin = 'this is email and password dashboard';
    //         $phone = $user->phone;

    //         Mail::to(env('MAIL_USERNAME'))
    //             ->send(new TenantRegisterMail($name, $email, $password, $messageSuperAdmin, $phone));

    //         Mail::to($user->email)
    //             ->send(new TenantRegisterMail($name, $email, $password, $messageAdmin, $phone));

    //     } catch (\Exception $e) {
    //         return redirect()->back()->with('error', 'Email could not be sent. Please try again.');
    //     }



    //     return redirect()->back()->with('success', 'Tenant Create successful!');
    // }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $tenants = Tenant::findOrFail($id);
        return view('dashboard.tenants.show', compact('tenants'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $tenants = Tenant::findOrFail($id);
        return view('dashboard.tenants.show', compact('tenants'));
    }

    /**
     * Update the specified resource in storage.
     */
    // public function update(Request $request, string $id)
    // {
    //     $tenant = Tenant::find($id);
    //     $user = $tenant->user;

    //     if (isset($request->image)) {
    //         $user->image = $this->updateFile($request->image, $user->image, $this->filePath);
    //     }

    //     try {
    //         $name = $request->name;
    //         $email = $request->email;
    //         $password = $request->password;
    //         $messageSuperAdmin = 'update customer';
    //         $messageAdmin = 'this is email and password new in dashboard';
    //         $phone = $user->phone;

    //         Mail::to(env('MAIL_USERNAME'))
    //             ->send(new TenantRegisterMail($name, $email, $password, $messageSuperAdmin, $phone));

    //         Mail::to($user->email)
    //             ->send(new TenantRegisterMail($name, $email, $password, $messageAdmin, $phone));

    //     } catch (\Exception $e) {
    //         return redirect()->back()->with('error', 'Email could not be sent. Please try again.');
    //     }

    //     $user->update([
    //         'id' => $request->tenant,
    //         'name' => $request->tenant,
    //         'user_id' => $user->id,
    //     ]);

    //     $tenant->domains()->create([
    //         'domain' => $request->tenant,
    //     ]);

    //     return redirect()->back()->with('success', 'Tenant Create successful!');
    // }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Tenant::find($id)->delete();
        return redirect()->route('tenants.index')->with('success','Tenant Deleted Successfully');
    }
}
