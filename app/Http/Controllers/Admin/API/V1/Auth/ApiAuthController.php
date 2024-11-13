<?php

namespace App\Http\Controllers\Admin\API\V1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Helper\ResponseHelper;
use App\Http\Requests\Api\public\Auth\loginRequest;
use App\Http\Resources\Auth\UserAuthResource;
use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class ApiAuthController extends Controller
{
    /**
     * login auth admin dashboard
     */
        public function login(loginRequest $request)
        {
            if (!$token = auth('api')->attempt(["email" => $request->email, "password" => $request->password])) {
                return ResponseHelper::sendResponseError([], ResponseAlias::HTTP_BAD_REQUEST,'The Credential of email or password Incorrect');
            }
            $user = User::whereEmail($request->email)->first();
            if(auth('api')->user()->role_name == null){
                return redirect()->back()->with('warning', 'This pages for Administrator only');
            }
            $user->token = $token;
            return  ResponseHelper::jsonResponse(['user' => new UserAuthResource($user)]);
        }


}
