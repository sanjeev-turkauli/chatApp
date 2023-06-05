<?php

namespace App\Helpers;

class Helper{

    public static function authResponse($status,$msg,$type,$statusCode)
    {
        $response = ["status" => $status,"message" => $msg,"type" => $type,"status_code" => $statusCode,];
        return $response;
    }

}


