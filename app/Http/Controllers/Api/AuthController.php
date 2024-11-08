<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Services\AuthService;
use App\Http\Requests\LoginRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function login(LoginRequest $request)
    {
        $credentials = $request->only("username", "password");
        return $this->authService->authenticateUser($credentials);
    }

    public function logout()
    {
        return $this->authService->removeToken();
    }

    public function me()
    {
        return $this->authService->seeDetails();
    }
}
