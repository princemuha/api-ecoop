<?php

namespace App\Infrastructure\Auth\Repositories;

use App\Application\Auth\DTO\LoginDTO;
use App\Application\Auth\DTO\RegisterDTO;
use App\Application\Auth\DTO\RenewOTPDTO;
use App\Application\Auth\DTO\VerifyOTPDTO;

use App\Infrastructure\Auth\Contracts\AuthInterface;
use App\Infrastructure\Identifier\Contracts\IdentifierInterface;

use App\Infrastructure\Auth\Models\AuthUser;
use App\Infrastructure\Auth\Models\AuthMapRoles;

use App\Shared\Exeptions\ApiException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthEloquent implements AuthInterface
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        private IdentifierInterface $identifier
    )
    {
    }

    public function register(RegisterDTO $registerDTO)
    {
        $user_id = $this->identifier->generateID('system_user', 'user_id', 5);
        $otp = rand(100000, 999999);
        DB::transaction(function () use ($user_id, $otp, $registerDTO) {
            AuthUser::create([
                'user_id'       => $user_id,
                'username'      => $registerDTO->username ?? $registerDTO->email,
                'fullname'      => $registerDTO->fullname,
                'password'      => Hash::make($registerDTO->password),
                'email'         => $registerDTO->email,
                'status_active' => 'unverified',
                'otp'           => $otp,
                'otp_expires_at'=> now()->addMinutes(10),
            ]);
            AuthMapRoles::create([
                'map_user_role_id'  => $this->identifier->generateID('map_user_role', 'map_user_role_id', 5),
                'user_id'           => $user_id,
                'role_id'           => 5,
                'role_name'         => 'Customer',
            ]);
        });
        return $otp;
    }

    public function login(LoginDTO $loginDTO)
    {
        $user = AuthUser::where('username', $loginDTO->username)->OrWhere('email', $loginDTO->username)->first();
        return $user;
    }

    public function roles(int $user_id)
    {
        $roles = AuthMapRoles::select('role_id', 'role_name')->where('user_id', $user_id)->get();
        return $roles;
    }

    public function renewOTP(RenewOTPDTO $renewOTPDTO)
    {
        $user = AuthUser::where('user_id', $renewOTPDTO->user_id)->where('email', $renewOTPDTO->email);
        if ($user->first()) {
            $otp = rand(100000, 999999);
            $user->update([
                'otp' => $otp,
                'otp_expires_at' => now()->addMinutes(10),
            ]);
            return $otp;
        }
        throw new ApiException('User not found', 404);
    }

    public function verifyOTP(VerifyOTPDTO $verifyOTPDTO)
    {
        $getUser = AuthUser::where('user_id', $verifyOTPDTO->user_id)->where('otp', $verifyOTPDTO->otp);
        if (!$getUser->first()) {
            throw new ApiException('User or OTP incorrect',401);
        }
        $getUser->update([
            'status_active' => 'active',
            'otp' => null,
            'otp_expires_at' => null,
        ]);
        return (object) [];
    }

    public function deleteTokens($user)
    {
        $user->tokens()->delete();
    }
}
