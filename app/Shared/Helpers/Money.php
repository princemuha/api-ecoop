<?php

namespace App\Shared\Helpers;

class Money
{
    private float $amount;

    /**
     * Create a new class instance.
     */
    public function __construct(float $amount)
    {
        $this->amount = $amount;
    }

    public function format(int $decimal = 0)
    {
        return number_format($this->amount, $decimal, ',', '.');
    }
}
