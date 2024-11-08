<?php

namespace App\Traits;

trait ApiResponse
{
    public function ok($message = '', $data = [], $code = 200)
    {
        return response()->json([
            'message' => $message,
            'data' => $data
        ], $code);
    }

    public function success($message = 'success', $code = 200)
    {
        return response()->json([
            'message' => $message,
        ], $code);
    }

    public function error($message = 'error', $code = 400)
    {
        return response()->json([
            'message' => $message,
        ], $code);
    }
}
