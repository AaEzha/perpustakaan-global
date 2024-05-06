<?php

namespace App;

use Illuminate\Http\Response;

trait JsonResponse
{
    public function Ok($data = null, $message = 'Success', $code = Response::HTTP_OK)
    {
        return response()->json([
            'status' => $code,
            'message' => $message,
            'data' => $data,
        ], $code)->header('Content-Type', 'application/json');
    }

    public function Error($message = null, $code = Response::HTTP_BAD_REQUEST, $data = null)
    {
        return response()->json([
            'status' => $code,
            'message' => $message ? $message : 'Error',
            'data' => $data,
        ], $code)->header('Content-Type', 'application/json');
    }
}
