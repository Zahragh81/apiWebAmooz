<?php

namespace App\Traits;

use Illuminate\Support\Facades\Response;


//کدها باتوجه به دوره
//trait ApiResponse{
//    protected function successResponse($code, $data, $message = null)
//    {
//        return Response::json([
//            'status' => 'success',
//            'message' => $message,
//            'data' => $data,
//        ], $code);
//    }
//
//    protected function errorResponse($code, $message)
//    {
//        return Response::json([
//            'status' => 'error',
//            'message' => $message,
//        ], $code);
//    }
//}


trait ApiResponse
{
    protected function successResponse($data, $code = 200)
    {
        return Response::json([
            'status' => true,
            'data' => $data
        ], $code);
    }


    protected function errorResponse($message, $code = 200)
    {
        return Response::json([
           'status' => false,
           'message' => $message
        ], $code);
    }
}
