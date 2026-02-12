<?php

namespace App\Application\Auth\DTO;

class VerifyOTPDTO
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        public int $user_id,
        public int $otp
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['user_id'],
            $data['otp']
        );
    }

    public function toArray(): array
    {
        return [
            'user_id' => $this->user_id,
            'otp' => $this->otp
        ];
    }
}
