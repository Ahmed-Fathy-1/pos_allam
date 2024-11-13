<?php

namespace App\Http\Traits\Utils;

trait ApiResponseTrait
{
    /**
     * Send a success response with data.
     *
     * @param  mixed  $data
     * @param  string  $message
     * @param  int  $statusCode
     * @return \Illuminate\Http\JsonResponse
     */
    public function successResponse($data, $message = null, $statusCode = 200)
    {
        return response()->json([
            'success' => true,
            'message' => $message,
            'data' => $data,
        ], $statusCode);
    }

    /**
     * Send an error response.
     *
     * @param  string  $message
     * @param  int  $statusCode
     * @return \Illuminate\Http\JsonResponse
     */
    public function errorResponse($message, $statusCode = 500)
    {
        return response()->json([
            'success' => false,
            'error' => $message,
        ], $statusCode);
    }

    /**
     * Send a custom JSON response.
     *
     * @param  array  $data
     * @param  int  $statusCode
     * @return \Illuminate\Http\JsonResponse
     */
    public function customResponse($data, $statusCode)
    {
        return response()->json($data, $statusCode);
    }
}
