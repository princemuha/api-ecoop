<?php

namespace App\Application\Auth\UseCase;

use App\Application\Auth\DTO\VerifyOTPDTO;
use App\Infrastructure\Auth\Contracts\AuthInterface;

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
        return $this->authInterface->verifyOTP($verifyOTPDTO);
    }
}
