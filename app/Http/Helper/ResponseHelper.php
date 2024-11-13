<?php
namespace App\Http\Helper;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class ResponseHelper{
    /**
     * send response success
     * @param array $data
     * @param string $message
     * @param int $code
     * @return \Illuminate\Http\JsonResponse
     */
    public static function sendResponseSuccess($data=[] , int  $code = 200  , $message=null ){

        $response = self::responseData( true , $code  , $data , $message);
        return response()->json($response, $code);
    }

    /**
     *  Send response error
     * @param array $data
     * @param mixed $message
     * @param mixed $code
     * @return \Illuminate\Http\JsonResponse
     */
    public static function sendResponseError( $data , int  $code  , $message=null ){

        $response = self::responseData( false , $code  , $data , $message);
        return response()->json($response, $code);
    }


    /**
     * Json Response
     *
     * Used To Return Json Data
     * @param string|null $message
     * @param array|null $data
     * @param int|null $code
     * @return JsonResponse
     */
   public static function jsonResponse(array|null $data = null, string|null $message = null, int|null $code = null): JsonResponse
    {
        $code ??= Response::HTTP_OK;
        $message ??= "success";
        return response()->json(compact('code', 'message', 'data'), $code);
    }


    /**
     * Paginated Json Response
     *
     * Used To Return Paginated Json Data
     * @param string|null $message
     * @param array|null $data
     * @param int|null $code
     * @param string|null $paginatedDataKey
     * @return JsonResponse
     */

   public static function JsonResponseData(string|null $message = null,array|null $data = null, string $paginatedDataKey = null , int|null $code = null): JsonResponse {
        $code ??= Response::HTTP_OK;
        // Extracting paginated data
        $paginatedData = $data[$paginatedDataKey] ?? null;
        unset($data[$paginatedDataKey]);
        // Constructing response data
        $responseData = [
            'code' => $code,
            'message' => $message ?? "Success",
            'data' => $data,
        ];


        // If paginated data exists, include it in the response
        if ($paginatedData !== null) {

            $responseData['data'][$paginatedDataKey] = $paginatedData;
            $responseData['pagination'] = [
                'total' => $paginatedData->total(),
                'per_page' => $paginatedData->perPage(),
                'current_page' => $paginatedData->currentPage(),
                'last_page' => $paginatedData->lastPage(),
                'from' => $paginatedData->firstItem(),
                'to' => $paginatedData->lastItem(),
                'next_page_url' => $paginatedData->nextPageUrl(),
                'last_page_url' => $paginatedData->url($paginatedData->lastPage()),
                'previous_page_url' => $paginatedData->previousPageUrl(),
            ];
        }
        return response()->json($responseData, $code);
    }
    /**
     * Error Json Response
     *
     * Used To Return Error Json Data
     * @param string $userMessage
     * @param array|null $errors
     * @param int|null $code
     * @return JsonResponse
     */
   public static function errorResponse(string $userMessage, array|null $errors = null, int|null $code = null): JsonResponse
    {
        return response()->json([
            "code" => $code ??= Response::HTTP_BAD_REQUEST,
            "message" => $userMessage,
            ...$errors ??= []
        ], $code);
    }


    private static function responseData(bool $status , int $status_code , $data , $message){

        $message = $message ? $message : Response::$statusTexts[$status_code];

        return  [
            'status' =>  $status,
            'status_code'=>$status_code,
            'data'    => $data,
            'message' =>  $message,
        ];
    }





}
