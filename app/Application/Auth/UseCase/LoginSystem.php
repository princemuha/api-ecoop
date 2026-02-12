<?php

namespace App\Application\Auth\UseCase;

use App\Application\Auth\DTO\LoginDTO;
use App\Infrastructure\Auth\Contracts\AuthInterface;
use App\Shared\Exeptions\ApiException;
use Illuminate\Support\Facades\Hash;

class LoginSystem
{
    public function __construct(private AuthInterface $authInterface)
    {
    }

    public function execute(LoginDTO $loginDTO)
    {
        $user = $this->authInterface->login($loginDTO);
        if($user){
            if(!Hash::check($loginDTO->password, $user->password)){
                throw new ApiException('Invalid credential', 401);
            }
            if(!$user->isActive()){
                throw new ApiException('User is not active', 403);
            }
            if(!$user->isVerified()){
                throw new ApiException('User is not verified', 403);
            }
            // Hapus semua token lama sebelum membuat token baru
            $this->authInterface->deleteTokens($user);
            
            $return['user'] = $user;
            $return['roles'] = (object) $this->authInterface->roles($user->user_id);
            $return['token'] = $user->createToken('api_token')->plainTextToken;
            return (object) $return;
        }else{
            throw new ApiException('User not found', 404);
        }
    }
}
