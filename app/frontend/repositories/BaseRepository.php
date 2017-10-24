<?php

namespace Marser\App\Frontend\Repositories;

use \Phalcon\Di,
    \Phalcon\DiInterface,
    \Marser\App\Frontend\Models\ModelFactory;

class BaseRepository {

    /**
     * DI容器
     * @var \Phalcon\Di
     */
    private $_di;

    public $modelsManager;

    public function __construct(DiInterface $di = null){
        $this -> setDI($di);
        $this->modelsManager = $this->_di->getShared('modelsManager');
    }

    /**
     * 设置DI容器
     * @param DiInterface|null $di
     */
    public function setDI(DiInterface $di = null){
        empty($di) && $di = Di::getDefault();
        $this -> _di = $di;
    }

    /**
     * 获取DI容器
     * @return Di
     */
    public function getDI(){
        return $this -> _di;
    }

    /**
     * 获取模型对象
     * @param $modelName
     * @return mixed
     * @throws \Exception
     */
    protected function get_model($modelName){
        return ModelFactory::get_model($modelName);
    }
}
