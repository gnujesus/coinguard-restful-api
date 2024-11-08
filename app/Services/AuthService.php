<?php

namespace App\Services;

use App\Traits\ApiResponse;
use Illuminate\Support\Facades\Auth;

class AuthService
{
    use ApiResponse;

    public function authenticateUser($credentials)
    {
        if (!Auth::attempt($credentials)) {
            return $this->error('Invalid Credentials', 401);
        }

        $user = Auth::user();

        return $this->ok('Logged In', [
            'name' => $user->name,
            'username' => $user->username,
            'message' => 'authenticated',
            'token' => $user->createToken('token', ['*'], now()->addHours(15))->plainTextToken,
        ], 200);
    }

    public function removeToken()
    {
        Auth::user()->tokens()->delete();

        return $this->ok('Logged Out', [], 200);
    }

    public function seeDetails()
    {
        return $this->ok('User Details', Auth::user(), 200);
    }
}
