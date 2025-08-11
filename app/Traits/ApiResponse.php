<?php

namespace App\Traits;

trait ApiResponse{
    public function successResponse($data,$message,$code=200)
    {
        return response()->json([
            'success' => true,
            'message' => $message,
            'data' => $data,
        ], $code);
    }

    public function errorResponse($data,$message,$code=400){
        return response()->json([
            'success' => false,
            'message' => $message,
            'data' => $data,
        ], $code);
    }
}
