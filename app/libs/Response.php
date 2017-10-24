<?php

namespace Marser\App\Libs;

use Phalcon\Di;

/**
 * Class Response
 * @package Marser\App\Libs
 * @createBy : Bill
 */
class Response
{
    /**
     * @var int 接口请求失败
     */
    const HTTP_STATUS_FAILED = 10001;
    /**
     * @var int 解密失败
     */
    const HTTP_DECRYPT_FAILED = 10002;
    /**
     * @var int 缺少必要字段
     */
    const HTTP_STATUS_FAILED_MISSING_REQUIRE_FIELD = 10004;

    public static function responseJson($code = NULL, $message = '', $data = [],$headers = [], $retCode = 200)
    {
        $response = Di::getDefault()->get('response');
        $response->setHeader('Content-Type', 'application/json');
        if(!empty($headers)){
            foreach ($headers AS $headerName => $content){
                $response->setHeader($headerName, $content);
            }
        }
        $response->setStatusCode($retCode);
        $retData = array('code' => $code, 'message' => $message, 'timestamp' => date('Y-m-d H:i:s'));
        if (!empty($data)) {
            $retData['data'] = $data;
        }
        return $response->setJsonContent($retData)->send();
    }

    public static function responseJsonAndExit($code = NULL, $message = '', $data = array())
    {
        $retData = array('status' => $code, 'info' => $message, 'timestamp' => date('Y-m-d H:i:s'));
        if (!empty($data)) {
            $retData['data'] = $data;
        }
        exit(json_encode($retData));
    }

    public static function redirect($location = null, $externalRedirect = false, $statusCode = 302)
    {
        $ret = Di::getDefault()->get('response')->redirect($location, $externalRedirect, $statusCode);
        return $ret;
    }
}
