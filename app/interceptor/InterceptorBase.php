<?php

namespace Marser\App\Interceptor;


use Marser\App\Response\HttpCode;
use Marser\App\Response\HttpResponse;
use Phalcon\Http\Request;

/**
 * Class InterceptorBase
 * @package Marser\App\Interceptor
 * @createdBy : Bill
 */
abstract class InterceptorBase
{
    /**
     * @var
     */
    private $_errMsg;

    /**
     * @var
     */
    private $_request;

    /**
     * @return mixed
     */
    public function getRequest()
    {
        return $this->_request;
    }

    /**
     * @param mixed $request
     */
    public function setRequest($request)
    {
        $this->_request = $request;
    }

    public function __construct(Request $request)
    {
        $this->_request = $request;
    }

    /**
     * @author Bill
     */
    public function run()
    {
        if(!$this->exec($this->_request))
            return false;
        return true;
    }

    /**
     * error
     * @author Bill
     */
    public function error(){
        return HttpResponse::custRes($this->getErrMsg(),[],HttpResponse::ERR_CODE,[],HttpCode::UN_AUTH);
    }

    /**
     * @return mixed
     */
    public function getErrMsg()
    {
        return $this->_errMsg;
    }

    /**
     * @param mixed $errMsg
     */
    public function setErrMsg($errMsg)
    {
        $this->_errMsg = $errMsg;
    }

    abstract function exec(Request $req);

}