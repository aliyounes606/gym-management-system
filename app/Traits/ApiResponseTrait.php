<?php

namespace App\Traits;

trait ApiResponseTrait
{
    /**
     * Unified success response
     * @param mixed $data
     * @param mixed $message
     * @param mixed $code
     * @return \Illuminate\Http\JsonResponse
     */
    public function successResponse($data = [], $message = 'Operation Successful', $code = 200)
    {
        return response()->json([
            'status' => true,
            'message' => $message,
            'data' => $data
        ], $code);
    }

    /**
     * Uniform error response
     * @param mixed $message
     * @param mixed $code
     * @param mixed $errors
     * @return \Illuminate\Http\JsonResponse
     */
    public function errorResponse($message = 'Something went wrong', $code = 400, $errors = [])
    {
        return response()->json([
            'status' => false,
            'message' => $message,
            'errors' => $errors
        ], $code);
    }
}
