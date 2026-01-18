<?php

namespace App\Repositories\Auth;

use App\Domain\Auth\Contracts\AuthInterface;
use App\Models\Users\User;

class AuthEloquent implements AuthInterface
{
    public function login($username, $email)
    {
        return User::where('username', $username)->orWhere('email', $email)->first();
    }

    public function register($data)
    {
        return User::create($data);
    }

    public function delete($id)
    {
        return User::destroy($id);
    }

    public function store($data)
    {
        return User::create($data);
    }
}