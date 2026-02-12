<?php

namespace App\Application\Auth\DTO;

class LoginDTO
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        public string $username,
        public string $password
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['username'],
            $data['password']
        );
    }

    public function toArray(): array
    {
        return [
            'username' => $this->username,
            'password' => $this->password
        ];
    }
}
