<?php

namespace Marser\App\Common\Base;

use \Marser\App\Core\PhalBaseController,
    \Marser\App\Frontend\Repositories\RepositoryFactory,
    \Marser\App\Response\HttpResponse;


abstract class BaseController extends PhalBaseController {

    public function initialize()
    {
        parent::initialize();
        $this->_registerModels();
        $this->_setAllow();
    }

    private function _setAllow(){
        //字符处理
        header('content-type:application:json;charset=utf8');
        $origin = isset($_SERVER['HTTP_ORIGIN'])? $_SERVER['HTTP_ORIGIN'] : '';

        header('Access-Control-Allow-Origin: '."*");
        header('Access-Control-Allow-Credentials: true');
        header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
        header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, authKey, sessionId");
    }

    private function _registerModels(){
        $this->modelsManager->registerNamespaceAlias("Frontend","Marser\App\Frontend\Models");
    }

    protected function get_repository($repositoryName){
        return RepositoryFactory::get_repository($repositoryName);
    }

    protected function redirect($url=NULL){
        empty($url) && $url = $this -> request -> getHeader('HTTP_REFERER');
        $this -> response -> redirect($url);
    }

    /**
     * success
     * @param string $msg
     * @param array $data
     * @return mixed
     * @author Bill
     */
    protected function httpSuccess($msg = '',$data = []){
        return HttpResponse::success($msg,$data);
    }

    /**
     * error
     * @param string $msg
     * @param array $data
     * @author Bill
     */
    protected function httpError($msg = '',$data = []){
        return HttpResponse::error($msg,$data);
    }
}