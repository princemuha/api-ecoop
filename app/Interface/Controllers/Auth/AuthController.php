<?php

namespace App\Interface\Controllers\Auth;

use Illuminate\Routing\Controller;

use App\Application\Auth\DTO\LoginDTO;
use App\Application\Auth\DTO\RegisterDTO;
use App\Application\Auth\DTO\RenewOTPDTO;
use App\Application\Auth\DTO\VerifyOTPDTO;

use App\Interface\Requests\Auth\LoginRequest;
use App\Interface\Requests\Auth\RegisterRequest;
use App\Interface\Requests\Auth\RenewOTPRequest;
use App\Interface\Requests\Auth\VerifyOTPRequest;

use App\Application\Auth\UseCase\LoginSystem;
use App\Application\Auth\UseCase\LogoutSystem;
use App\Application\Auth\UseCase\RegisterUser;
use App\Application\Auth\UseCase\RenewOTP;
use App\Application\Auth\UseCase\VerifyOTP;

use App\Shared\Handlers\JsonHandler;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        private LoginSystem $loginSystem,
        private LogoutSystem $logoutSystem,
        private RegisterUser $registerUser,
        private RenewOTP $renewOTP,
        private VerifyOTP $verifyOTP,
        private JsonHandler $jsonHandler,
    ) {
    }

    public function login(LoginRequest $request)
    {
        $credentials = $request->validated();
        $loginDTO = LoginDTO::fromArray($credentials);
        return $this->jsonHandler->handle('success', $this->loginSystem->execute($loginDTO));
    }

    public function register(RegisterRequest $request)
    {
        $credentials = $request->validated();
        $registerDTO = RegisterDTO::fromArray($credentials);
        return $this->jsonHandler->handle('success', $this->registerUser->execute($registerDTO));
    }

    public function renewOTP(RenewOTPRequest $request)
    {
        $credentials = $request->validated();
        $renewOTPDTO = RenewOTPDTO::fromArray($credentials);
        return $this->jsonHandler->handle('success', $this->renewOTP->execute($renewOTPDTO));
    }

    public function verifyOTP(VerifyOTPRequest $request)
    {
        $credentials = $request->validated();
        $verifyOTPDTO = VerifyOTPDTO::fromArray($credentials);
        return $this->jsonHandler->handle('success', $this->verifyOTP->execute($verifyOTPDTO));
    }

    public function logout(Request $request){
        return $this->jsonHandler->handle('success', $this->logoutSystem->execute($request->user()));
    }
}
