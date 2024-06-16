<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthenticateUserRequest;
use App\Http\Resources\AuthenticatedUserResource;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    public function index() 
    {
        $users = User::all();

        if ($users->count() > 0) {
            return response()->json(['users' => $users]);
        } else {
            return response()->json([
                'users' => 'No Users Found'
            ]);
        }
    }


    //Login
    public function login(AuthenticateUserRequest $payload){
        $username = $payload->username; 
        $password = $payload->password;

        $user = User::where('username', $username)->first();

        if(!$user || !Hash::check($password, $user->password)){
            throw ValidationException::withMessages([
                'username' => ['The provided credentials are incorrect'],
            ]);
        }

        $response = (object) [
            'user' => new UserResource($user),
            'token' => $user->createToken('auth-token')->plainTextToken
        ];

        return new AuthenticatedUserResource($response);
    }

    public function logout(Request $payload){
        $taker = $payload->user();
        $taker->tokens()->delete();
        return "logout success";
    }
}
