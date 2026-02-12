<?php

namespace App\Application\Auth\UseCase;

use App\Application\Auth\DTO\RegisterDTO;
use App\Infrastructure\Auth\Contracts\AuthInterface;

class RegisterUser
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        private AuthInterface $authInterface,
    ) {
    }

    public function execute(RegisterDTO $registerDTO)
    {
        $user = $this->authInterface->register($registerDTO);
        return (object) ['otp' => $user];
    }
}
