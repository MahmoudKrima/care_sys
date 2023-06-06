<?php

namespace App\Traits;

trait ApiResponseTrait
{
    public static function apiResponse($data = [], $message , $status = 200)
    {
        return response()
        ->json([
            'data' => $data,
            'message' => $message,
            'status' => $status
        ],$status);
    }
}



?>
