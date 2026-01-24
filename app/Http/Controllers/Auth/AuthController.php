<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Domain\Auth\Services\AuthService;
use App\Domain\Identifier\Services\IdService;
use Illuminate\Support\Facades\Hash;

class AuthController
{
    public function __construct(protected AuthService $authService, protected IdService $IdService)
    {
    }

    public function login(Request $request)
    {
        $request->validate(['username' => 'required|string', 'password' => 'required']);
        return $this->authService->login($request);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()?->delete();
        return ['message' => 'success'];
    }

    public function register(Request $request)
    {
        try {
            $data = $request->validate([
                'username' => 'required|string|unique:system_user,username',
                'fullname' => 'required|string',
                'email' => 'required|email|unique:system_user,email',
                'password' => 'required|min:4'
            ]);

            $data['user_id'] = $this->IdService->getID5('system_user', 'user_id');
            $data['password'] = Hash::make($data['password']);
            $data['created_by'] = $data['fullname'];
            $data['otp'] = rand(100000, 999999);
            $data['otp_expires_at'] = now()->addMinutes(10);

            return $this->authService->register($request, $data);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function verify(Request $request)
    {
        try {
            $request->validate([
                'user_id' => 'required|integer',
                'otp' => 'required|integer',
            ]);
            return $this->authService->verify($request);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function renewOTP(Request $request)
    {
        try {
            $request->validate([
                'user_id' => 'required|integer',
                'email' => 'required|email',
            ]);
            return $this->authService->renewOTP($request);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => $th->getMessage()
            ], 500);
        }
    }
}