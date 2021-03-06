<?php

namespace App\Services;

use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\UserRegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthService
{
    public function __construct(User $userModel)
    {
        $this->userModel = $userModel;
    }

    public function register(UserRegisterRequest $request)
    {
        return $this->userModel->create(array_merge(
            $request->only($this->userModel->getFillable()),
            ['password' => Hash::make($request->password)]
        ));
    }

    public function login(UserLoginRequest $request)
    {
        $credentials = $request->only('email', 'password');
        $attempt = Auth::attempt($credentials);
        if (! $attempt) {
            return null;
        }
        $user = Auth::user();
        $token = $user->createToken('auth');
        return $token->plainTextToken;
    }

    public function logout(User $user)
    {
        $user->currentAccessToken()->delete();
        return true;
    }
}
