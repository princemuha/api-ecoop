<?php

namespace App\Infrastructure\Auth\Contracts;

use App\Application\Auth\DTO\LoginDTO;
use App\Application\Auth\DTO\RegisterDTO;
use App\Application\Auth\DTO\RenewOTPDTO;
use App\Application\Auth\DTO\VerifyOTPDTO;

interface AuthInterface
{
    public function register(RegisterDTO $registerDTO);
    public function login(LoginDTO $loginDTO);
    public function roles(int $user_id);
    public function renewOTP(RenewOTPDTO $renewOTPDTO);
    public function verifyOTP(VerifyOTPDTO $verifyOTPDTO);
    public function deleteTokens($user);
}
