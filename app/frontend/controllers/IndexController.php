<?php

namespace Marser\App\Frontend\Controllers;

use Marser\App\Common\Base\BaseController;


class IndexController extends BaseController{

    public function initialize()
    {
        parent::initialize();

    }

    public function indexAction(){

    }


    public function notfoundAction(){

        $this -> view -> disableLevel(array(
            \Phalcon\Mvc\View::LEVEL_MAIN_LAYOUT => false,
        ));
        $this -> view -> pick('index/404');
    }

}