<?php

namespace App\Domain\Auth\Services;

use App\Domain\Auth\Contracts\AuthInterface;
use App\Domain\Identifier\Contracts\IdInterface;
use App\Domain\Roles\Contracts\MapRolesInterface;
use Illuminate\Support\Facades\Hash;

class AuthService
{
    public function __construct(
        protected AuthInterface $auth,
        protected IdInterface $id,
        protected MapRolesInterface $mapRoles
    ) {
    }
    public function login($request)
    {
        $user = $this->auth->login($request->username, $request->email);
        if (!$user || !Hash::check($request->password, $user->password)) {
            return ['message' => 'Invalid credentials'];
        }
        if (!$user->isVerified()) {
            return ['message' => 'Pending email verification'];
        }
        if (!$user->isActive()) {
            return ['message' => 'User status inactive'];
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
        // try {
        $data['otp'] = rand(100000, 999999);
        $data['otp_expires_at'] = now()->addMinutes(10);
        $data['password'] = Hash::make($request->password);
        $savedUser = $this->auth->store($data);
        if (!$savedUser) {
            return ['message' => 'Failed to save new user.'];
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
        return ['message' => 'success', 'otp' => $data['otp']];
        // } catch (\Throwable $th) {
        //     $this->logging->errorLog($request, $th);
        //     return ['message' => $th->getMessage()];
        // }
    }
}
