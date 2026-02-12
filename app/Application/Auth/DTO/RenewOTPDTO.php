<?php

namespace App\Application\Auth\DTO;

class RenewOTPDTO
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        public string $user_id,
        public string $email
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['user_id'],
            $data['email']
        );
    }

    public function toArray(): array
    {
        return [
            'user_id' => $this->user_id,
            'email' => $this->email
        ];
    }
}
