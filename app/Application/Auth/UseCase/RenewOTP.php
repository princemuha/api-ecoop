<?php

namespace App\Application\Auth\UseCase;

use App\Application\Auth\DTO\RenewOTPDTO;
use App\Infrastructure\Auth\Contracts\AuthInterface;
use Illuminate\Support\Facades\Log;

class RenewOTP
{
    /**
     * Create a new class instance.
     */
    public function __construct(private AuthInterface $authInterface)
    {
    }

    public function execute(RenewOTPDTO $renewOTPDTO)
    {
        Log::channel('discord-system')->info('Renew OTP success', ['user' => auth()->user()]);
        return (object) ['otp' => $this->authInterface->renewOTP($renewOTPDTO)];
    }
}
