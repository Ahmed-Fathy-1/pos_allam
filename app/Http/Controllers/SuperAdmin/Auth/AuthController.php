<?php

namespace App\Http\Controllers\SuperAdmin\Auth;

use App\Models\SuperAdmin\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Traits\Utils\UploadFileTrait;
use Illuminate\Validation\ValidationException;
use App\Http\Requests\SuperAdmin\Dashboard\LoginRequest;
use App\Http\Requests\SuperAdmin\Dashboard\ProfileRequest;

class AuthController extends Controller
{

    use UploadFileTrait;


    public function loginPage()
    {
        return view('dashboard.auth.login');
    }

    public function login(LoginRequest $request)
    {
        if (!auth()->attempt(["email" => $request->email, "password" => $request->password])) {
            throw ValidationException::withMessages(['The provided credentials are incorrect.']);
        }
        // return the token

        $user = User::where('email', $request->email)->first();

        $token = $user->createToken('auth_token')->plainTextToken;

        return redirect()->route('homePage');

    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('loginPage');
    }

    public function profile()
    {
        $user = User::whereId(auth()->user()->id)->first();
        return view('dashboard.auth.profile', compact('user'));
    }

    public function updateProfile(ProfileRequest $request)
    {
        $user = User::findOrFail(auth()->user()->id);

        if (isset($request->image)) {
            $image = $this->updateFile($request->image, $user->image, 'images/users');
        } else {
            $image = $user->image;
        }

        if (isset($request->password)) {
            $password = bcrypt($request->password);
        } else {
            $password = $user->password;
        }

        if (isset($request->email)) {
            $email = $request->email;
        } else {
            $email = $user->email;
        }

        $user->update([
            "name" => $request->name,
            "password" => $password,
            "email" => $email,
            "image" => $image,
        ]);
        return redirect()->back()->with('success', 'Data Updated Successfully');
    }

    // public function forgetPasswordPage()
    // {
    //     return view('dashboard.auth.forget-password-page');
    // }

    // public function forgetPassword(Request $request)
    // {
    //     $data = $request->validate([
    //         'email' => 'required|email|exists:users'
    //     ]);

    //     // Delete all old code that user send before.
    //     ResetCodePassword::where('email', $request->email)->delete();

    //     // Generate random code
    //     $data['code'] = mt_rand(100000, 999999);

    //     // Create a new code
    //     $codeData = ResetCodePassword::create($data);

    //     // Send email to user
    //     Mail::to($request->email)->send(new SendCodeResetPassword($codeData->code));

    //     return view('dashboard.auth.check-code')->with('success', 'code sent');
    // }


    // public function checkCode(Request $request)
    // {

    //     $request->validate([
    //         'code' => 'required|string|exists:reset_code_passwords',
    //         'password' => 'required|string|min:8|confirmed'
    //     ]);

    //     // find the code
    //    $passwordReset = ResetCodePassword::firstWhere('code', $request->code);

    //     // check if it does not expired: the time is one hour
    //     if ($passwordReset->created_at > now()->addHour()) {
    //         $passwordReset->delete();
    //         return redirect()->back()->with('success', 'passwords.code_is_expire');
    //     }

    //     // find user's email
    //     $user = User::firstWhere('email', $passwordReset->email);

    //     // update user password
    //     $user->update([
    //         'password' => Hash::make($request->password)
    //     ]);

    //     // delete current code
    //     $passwordReset->delete();

    //     return redirect()->route('loginPage');
    // }

}
