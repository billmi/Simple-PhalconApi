<?php

namespace Marser\App\Response;

use Marser\App\Libs\Response;


/**
 * Class UserHttpResponse
 * @package Marser\App\Response
 */
class UserHttpResponse extends Response
{

    const SUCC_CODE = 1;

    const ERR_CODE = 0;

    private $_headers = [];

    private static function _getHeaders(){
        return ["author" => "123456"];
    }

    public static function success($msg = '', $data = [],$header = true)
    {
        $headerSign = [];
        if($header)
            $headerSign = self::_getHeaders();
        return self::responseJson(self::SUCC_CODE, $msg, $data,$headerSign,HttpCode::SUCCESS);
    }

    public static function custRes($msg = '', $data = [], $code = 0, $header = true,$httpCode = 0)
    {
        $headerSign = [];
        if($header)
            $headerSign = self::_getHeaders();
        return self::responseJson($code, $msg, $data, $headerSign,$httpCode);
    }

    public static function error($msg = '', $data = [],$header = true)
    {
        $headerSign = [];
        if($header)
            $headerSign = $headerSign = self::_getHeaders();
        self::responseJson(self::ERR_CODE, $msg, $data, $headerSign,HttpCode::SUCCESS);
    }
}

