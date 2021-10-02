<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function response($message, $data, $status = 200, $isSuccess = true): JsonResponse
    {
        return response()->json([
            'success' => $isSuccess,
            'message'=> $message,
            'data' => $data,
        ],$status);
    }
}
