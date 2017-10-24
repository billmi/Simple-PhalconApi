<?php

namespace Marser\App\Interceptor;
use Marser\App\Helpers\EncryptHelper;

use Marser\App\Service\RedisService;
use Phalcon\Http\Request;

/**
 * Class HttpRequestInterceptor
 * @author : Bill
 */
class UserRequestInterceptor extends InterceptorBase implements InterceptorInterface{

    private $_signName = 'author';

    public function __construct(Request $request)
    {
        parent::__construct($request);
    }

    public function authSign()
    {
        parent::run();
    }

    function exec(Request $req)
    {
        $sign = $req->getHeader($this->_signName);
        if($sign == null || $sign == ''){
            $this->setErrMsg("未授权!禁止访问!");
            return false;
        }
        if(!$this->_checkAuth($sign)){
            $this->setErrMsg("未授权!禁止访问!");   //签名错误
            return false;
        }
    }

    private function _checkAuth($sign){

        exit;
    }
}