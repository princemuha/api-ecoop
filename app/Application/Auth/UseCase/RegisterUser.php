<?php

namespace App\Application\Auth\UseCase;

use App\Application\Auth\DTO\RegisterDTO;
use App\Infrastructure\Auth\Contracts\AuthInterface;
use Illuminate\Support\Facades\Log;

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
        Log::channel('discord-system')->info('New user registered', ['user' => $user]);
        return (object) ['otp' => $user];
    }
}
