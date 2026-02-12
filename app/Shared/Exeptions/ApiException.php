<?php

namespace App\Shared\Exeptions;

use Exception;

class ApiException extends Exception
{
    public function __construct(
        string $message,
        public int $status = 400
    ) {
        parent::__construct($message);
    }

    public function render()
    {
        return response()->json([
            'status' => $this->status,
            'message' => $this->message,
        ], $this->status);
    }
}

