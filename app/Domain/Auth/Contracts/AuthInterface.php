<?php

namespace App\Domain\Auth\Contracts;

interface AuthInterface
{
    public function login($username, $email);
    public function register($data);
    public function delete($id);
    public function store($data);
    public function verify($user_id, $otp);
    public function verifyUpdate($user_id, $data);
    public function renewOTP($data);
}
