<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;
use stdClass;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    /** 
     * To format a success response for API request.
     * @param string $message
     * @param array $data
     * 
     * @return JsonResponse
    */
    public function success($message = '', $data = []): JsonResponse {

        return response()->json([
            'success' => true,
            'message' => $message,
            'code' => 200,
            'data' => $data ?: new stdClass,
        ]);
    }

    /** 
     * To format a error response for API request.
     * @param string $message
     * @param int $code
     * 
     * @return JsonResponse
    */
    public function error($message, $code): JsonResponse {

        return response()->json([
            'success' => false,
            'message' => $message,
            'code' => $code ?: 500
        ], $code ?: 500);
    }
}
