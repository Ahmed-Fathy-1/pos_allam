<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Http\Helper\ResponseHelper;
use App\Http\Requests\Admin\UpdateProfileRequest;
use App\Http\Requests\Api\public\Auth\ChangePasswordRequest;
use App\Http\Requests\Api\public\Auth\loginRequest;

use App\Models\User;
use App\services\employeeService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class AdminLoginController extends Controller
{
    public function getLogin(){
        return view('Admin.pages.Auth.login');
    }

    public function login(loginRequest $request){
        $validated = $request->validated();
        if(! auth()->attempt(['email' => $validated['email'],'password' => $validated['password']])){
            return redirect()->back()->withErrors([ 'The email or password doesn\'t match']);
        }
        if(auth()->user()->role_name == null){
            return redirect()->back()->withErrors('warning', 'This pages for Administrator only');
        }

        if (\auth()->user()->hasRole('cashier')){
            return  redirect()->route('newIndex');
        }elseif (\auth()->user()->hasRole('delivery')){
            return redirect()->route('delivery');
        }
        return redirect()->route('dashboard');
    }



    public function profile(){
        $user = User::findOrFail(auth()->user()->id);
        return view('Admin.pages.profile.index',compact('user'));
    }

    public function updateProfile(UpdateProfileRequest $request,employeeService $service){

        $user = User::findOrFail(auth()->user()->id);
        if ($request->hasFile('image')){
            $oldFilePath = asset('storage/employee/'.$user->image);
            if (file_exists($oldFilePath)) {
                unlink($oldFilePath);
            }
            $image = $request->image;
            $filename = $service->image($image);
            $user->update(['image' => $filename]);
        }
        $user->update([
            'name' => $request->name,
            "email" => $request->email,
            "mobile" => $request->mobile
        ]);
        return redirect()->route('profile')->with('success','Profile Updated Successfully');
    }

    public function getPassword(){

        return view('Admin.pages.profile.changePassword');
    }

    public function updatePassword(ChangePasswordRequest $request){
        $user = auth()->user();
        $oldHashedPassword = $user->password;
        if (!Hash::check($request->old_password, $oldHashedPassword)){
            return redirect()->back()->withErrors('The old password is incorrect');
        }
        $user->password = $request->new_password;
        $user->save();
        return redirect()->back()->with('success','Password Changed Successfully');
    }


    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('get-name');
    }

}
