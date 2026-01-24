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

    public function verify($user_id, $otp)
    {
        return User::where('user_id', $user_id)->where('otp', $otp)->first();
    }

    public function verifyUpdate($user_id, $data)
    {
        return User::where('user_id', $user_id)->update($data);
    }

    public function renewOTP($data)
    {
        $dataUpdate = [
            'otp' => $data['otp'],
            'otp_expires_at' => $data['otp_expires_at'],
        ];
        User::where('user_id', $data['user_id'])->where('email', $data['email'])->update($dataUpdate);
        return $dataUpdate['otp'];
    }
}