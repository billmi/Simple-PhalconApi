<?php

namespace Marser\App\Common\Base;

use \Marser\App\Core\PhalBaseController,
    \Marser\App\Frontend\Repositories\RepositoryFactory,
    \Marser\App\Response\UserHttpResponse;
use Marser\App\Interceptor\UserRequestInterceptor;


abstract class UserBaseController extends PhalBaseController
{

    public function initialize()
    {
        parent::initialize();
    }

    public function beforeExecuteRoute(){
        $userRequestInterceptor = new UserRequestInterceptor($this->request);
        if(!$userRequestInterceptor->authSign()){
            return $userRequestInterceptor->error();
        }
    }

    protected function get_repository($repositoryName)
    {
        return RepositoryFactory::get_repository($repositoryName);
    }

    protected function redirect($url = NULL)
    {
        empty($url) && $url = $this->request->getHeader('HTTP_REFERER');
        $this->response->redirect($url);
    }

    protected function success($msg = '', $data = [],$header = true)
    {
        return UserHttpResponse::success($msg, $data,$header);
    }

    protected function error($msg = '', $data = [],$header = true)
    {
        return UserHttpResponse::error($msg, $data,$header);
    }
}