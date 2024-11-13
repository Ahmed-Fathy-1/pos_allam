<?php

namespace App\Http\Controllers\Api\public\Auth;

use App\Http\Controllers\Controller;
use App\Http\Helper\ResponseHelper;
use App\Http\Requests\Api\public\Auth\ChangePasswordRequest;
use App\Http\Requests\Api\public\Auth\loginRequest;
use App\Http\Requests\Api\public\Auth\RegisterRequest;
use App\Http\Resources\Auth\UserAuthResource;
use App\Models\Customer;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class AuthController extends Controller
{
    public function register(RegisterRequest $request){
        try {
            $user = User::create($request->validated());
            $token = auth('api')->attempt(["email" => $request->email, "password" => $request->password]);
            $user->token = $token;
            return ResponseHelper::sendResponseSuccess(new UserAuthResource($user));
        }catch (\Exception $ex){
            return ResponseHelper::sendResponseError([], ResponseAlias::HTTP_BAD_REQUEST,$ex->getMessage());
        }
    }

    public function login(loginRequest $request)
    {
        if (!$token = auth('api')->attempt(["email" => $request->email, "password" => $request->password])) {
            return ResponseHelper::sendResponseError([], ResponseAlias::HTTP_BAD_REQUEST,'The Credential of email or password Incorrect');
        }
        $user = User::whereEmail($request->email)->first();
        if ($user->is_block == 1) {
            return ResponseHelper::sendResponseError([], ResponseAlias::HTTP_BAD_REQUEST, 'Your account has been restricted by the site administration');
        }
        $user->token = $token;
        return ResponseHelper::sendResponseSuccess(new UserAuthResource($user));
    }

    public function changePassword(ChangePasswordRequest $request){
        try {
            $user = auth('api')->user();
            $oldHashedPassword = $user->password;
            if (!Hash::check($request->old_password, $oldHashedPassword)){
                return ResponseHelper::sendResponseError([], ResponseAlias::HTTP_BAD_REQUEST, 'The old password is incorrect. ');
            }
            $user->password = $request->new_password;
            $user->save();
            return ResponseHelper::sendResponseSuccess('Password updated successfully');
        }catch (\Exception $ex){
            return ResponseHelper::sendResponseError([], ResponseAlias::HTTP_BAD_REQUEST,$ex->getMessage());
        }
    }


}
