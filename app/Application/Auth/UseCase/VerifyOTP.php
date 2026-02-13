<?php

namespace App\Application\Auth\UseCase;

use App\Application\Auth\DTO\VerifyOTPDTO;
use App\Infrastructure\Auth\Contracts\AuthInterface;
use Illuminate\Support\Facades\Log;

class VerifyOTP
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        private AuthInterface $authInterface
    )
    {
        //
    }

    public function execute(VerifyOTPDTO $verifyOTPDTO)
    {
        Log::channel('discord-system')->info('Verify OTP success', ['user' => auth()->user()]);
        return $this->authInterface->verifyOTP($verifyOTPDTO);
    }
}
