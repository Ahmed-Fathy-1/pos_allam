<?php

namespace App\Http\Controllers\Api\SuperAdmin\Auth;

use App\Http\Controllers\Controller;
use App\Http\Helper\ResponseHelper;
use App\Http\Requests\Api\public\Auth\loginRequest;
use App\Http\Requests\Api\public\Auth\RegisterRequest;
use App\Http\Resources\Auth\UserAuthResource;
use App\Models\SuperAdmin\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
class AuthController extends Controller
{

    public function register(RegisterRequest $request)
    {
        $validated = $request->validated(); // Ensure valid input
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'mobile' => $validated['mobile'],
            'password' => Hash::make($validated['password']),
        ]);
        $user->token = $user->createToken('API Token')->plainTextToken;
        return ResponseHelper::sendResponseSuccess([
            'user' => new UserAuthResource($user),
        ]);
    }


    public function login(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $user->token = $user->createToken('API Token')->plainTextToken;

            return ResponseHelper::sendResponseSuccess([
                'user' => new UserAuthResource($user),
            ]);
        }

        return response()->json(['error' => 'Unauthorized'], 401);
    }

    public function logout()
    {
        // Get the current authenticated user
        $user = auth('api')->user();

        // Check if the user is authenticated
        if ($user) {
            // Delete the user's current access token
            $user->currentAccessToken()->delete();

            // Return a successful response
            return response()->json(['message' => 'Logout successfully'], 200);
        }

        // Return an error response if the user is not authenticated
        return response()->json(['error' => 'Unauthorized'], 401);
    }



}
