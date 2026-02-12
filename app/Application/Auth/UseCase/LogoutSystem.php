<?php

namespace App\Application\Auth\UseCase;

use App\Infrastructure\Auth\Contracts\AuthInterface;

class LogoutSystem
{
    /**
     * Create a new class instance.
     */
    public function __construct(private AuthInterface $authInterface)
    {
    }

    public function execute($request){
        $this->authInterface->deleteTokens($request);
        return (object) [];
    }
}
