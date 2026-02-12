<?php

namespace App\Application\Auth\UseCase;

use App\Application\Auth\DTO\RenewOTPDTO;
use App\Infrastructure\Auth\Contracts\AuthInterface;

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
        return (object) ['otp' => $this->authInterface->renewOTP($renewOTPDTO)];
    }
}
