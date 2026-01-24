<?php

namespace App\Domain\Auth\Services;

use App\Domain\Auth\Contracts\AuthInterface;
use App\Domain\Identifier\Contracts\IdInterface;
use App\Domain\Roles\Contracts\MapRolesInterface;
use App\Domain\Logging\Contracts\LoggingInterface;
use Illuminate\Support\Facades\Hash;

class AuthService
{
    public function __construct(
        protected AuthInterface $auth,
        protected IdInterface $id,
        protected MapRolesInterface $mapRoles,
        protected LoggingInterface $logging
    ) {
    }
    public function login($request)
    {
        $user = $this->auth->login($request->username, $request->email);
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }
        if (!$user->isVerified()) {
            return response()->json(['message' => 'Pending email verification'], 401);
        }
        if (!$user->isActive()) {
            return response()->json(['message' => 'User status inactive'], 401);
        }
        $token = $user->createToken('mobile-token')->plainTextToken;
        return [
            'user' => $user,
            'roles' => $this->mapRoles->showByUser($user->user_id),
            'token' => $token
        ];
    }

    public function logout()
    {
        return true;
    }

    public function register($request, $data)
    {
        try {
            $savedUser = $this->auth->store($data);
            if (!$savedUser) {
                return response()->json(['message' => 'Failed to save new user.'], 500);
            }
            $dataRoles = [
                'map_user_role_id' => $this->id->getID5('map_user_role', 'map_user_role_id'),
                'user_id' => $data['user_id'],
                'role_id' => 6,
                'role_name' => 'Customer',
                'created_by' => $data['fullname'],
            ];

            $this->mapRoles->store($dataRoles) ?? $this->auth->delete($data['user_id']);

            // if (!\App\Jobs\SendOtpEmail::dispatch($data['email'], $data['otp'], $data['fullname'])) {
            //     $this->auth->delete($data['user_id']);
            //     $this->mapRoles->delete($data['user_id']);
            //     return ['message' => 'Failed to send OTP email.'];
            // }
            return response()->json(['message' => 'success', 'otp' => $data['otp']], 201);
        } catch (\Throwable $th) {
            // $this->logging->errorLog($request, $th);
            return response()->json(['message' => $th->getMessage()], 500);
        }
    }

    public function verify($request)
    {
        $verify = $this->auth->verify($request->user_id, $request->otp);
        if (!@$verify->user_id) {
            return response()->json(['message' => 'OTP incorrect'], 401);
        }
        if (@$verify->otp_expires_at < now()) {
            return response()->json(['message' => 'OTP expired'], 401);
        }
        try {
            $this->auth->verifyUpdate($request->user_id, [
                'email_verified_at' => now(),
                'otp' => null,
                'otp_expires_at' => null,
                'status_active' => 'active',
                'updated_at' => now(),
                'updated_by' => $verify->fullname,
            ]);
            return response()->json(['message' => 'success'], 200);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'failed to update verification'], 500);
        }
    }

    public function renewOTP($request)
    {
        $data = [
            'user_id' => $request->user_id,
            'email' => $request->email,
            'otp' => rand(100000, 999999),
            'otp_expires_at' => now()->addMinutes(10),
        ];
        $renewOTP = $this->auth->renewOTP($data);
        if (!$renewOTP) {
            return response()->json(['message' => 'failed to renew OTP'], 401);
        }
        return response()->json(['message' => 'success', 'otp' => $renewOTP], 200);
    }
}
