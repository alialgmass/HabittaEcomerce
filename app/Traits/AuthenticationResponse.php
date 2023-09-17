<?php
namespace App\Traits;

use Illuminate\Http\Response;
trait  AuthenticationResponse{


    public function successfully($msg, $user, $token)
    {
        return response()->json([
            'status' => true,
            'message' => $msg,
            'data' => [
                'user' => $user,
                'token' => $token,
            ]
        ], Response::HTTP_OK);
    }

    public function failed($msg , $errors = [])
    {
        return response()->json([
            'status' => false,
            'message' => $msg,
            'errors' => $errors
        ],Response::HTTP_UNAUTHORIZED);
    }
    public function logoutMSG($msg)
    {
        return response()->json([
            'status' => true,
            'message' => $msg,
        ],Response::HTTP_OK);
    }

}

?>
