<?php

namespace App\Application\Auth\DTO;

class RegisterDTO
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        public string $username,
        public string $fullname,
        public string $password,
        public string $email,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            $data['username'] ?? $data['email'],
            $data['fullname'],
            $data['password'],
            $data['email'],
        );
    }

    public function toArray(): array
    {
        return [
            'username' => $this->username,
            'fullname' => $this->fullname,
            'password' => $this->password,
            'email' => $this->email,
        ];
    }
}
