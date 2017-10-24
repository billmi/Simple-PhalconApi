<?php

namespace Marser\App\Response;

use Marser\App\Libs\Response;

/**
 * Class HttpResponse
 * @package Marser\App\Response
 * @craetedBy : Bill
 */
class HttpResponse extends Response
{

    const SUCC_CODE = 1;


    const ERR_CODE = 0;


    public static function success($msg = '', $data = [],$header = [])
    {
        return self::responseJson(self::SUCC_CODE, $msg, $data,$header,HttpCode::SUCCESS);
    }


    public static function custRes($msg = '', $data = [], $code = 0, $headers = [],$httpCode = 0)
    {
        return self::responseJson($code, $msg, $data, $headers,$httpCode);
    }


    public static function error($msg = '', $data = [],$header = [])
    {
        return self::responseJson(self::ERR_CODE, $msg, $data, $header,HttpCode::SUCCESS);
    }
}
