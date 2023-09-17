<?php
namespace App\Traits;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

trait  messageTrait{

    public function successfully($msg, $data, $status = Response::HTTP_OK)
    {
        return response()->json([
            'result' => true,
            'message' => $msg,
            'status' =>  $status,
            'data' => $data
        ],$status);
    }

    public function failed($msg, $status = JsonResponse::HTTP_NOT_FOUND)
    {
        return response()->json([
            'result' => false,
            'message' => $msg,
            'status' => $status,
        ], $status);
    }

    public function notVerify($msg, $data)
    {
        return response()->json([
            'result' => false,
            'message' => $msg,
            'last_step' => 'verify',
            'status' => Response::HTTP_FORBIDDEN,
            'data' => $data
        ], Response::HTTP_FORBIDDEN);
    }

}

?>
