<?php

namespace App\Shared\Handlers;

class JsonHandler
{
    public function handle($status, object $data, $message = 'OK', $code = 200)
    {
        return $this->$status($data, $message, $code);
    }
    public function success($data, $message = 'OK', $code = 200)
    {
        return response()->json([
            'status' => $code,
            'message' => $message,
            'data' => $data,
        ], $code);
    }

    public function error($data, $message, $code = 400)
    {
        return response()->json([
            'status' => $code,
            'message' => $message,
        ], $code);
    }
}