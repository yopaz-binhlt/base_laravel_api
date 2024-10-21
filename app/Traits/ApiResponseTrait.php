<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

trait ApiResponseTrait
{


    public static function responseSuccess($data=null, $code=Response::HTTP_OK): JsonResponse
    {
        $response = [
            'code'   => $code,
            'status' => 'success',
            'data'   => $data,
        ];

        return response()->json($response);

    }//end responseSuccess()


    public static function responseError($message='', $code='', $data=null): JsonResponse
    {
        $response = [
            'code'    => $code,
            'status'  => 'error',
            'message' => $message,
            'data'    => $data,
        ];

        return response()->json($response, $code);

    }//end responseError()


}
