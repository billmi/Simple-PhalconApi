<?php

namespace Marser\App\Frontend\Models;

class ModelFactory {

    /**
     * 模型对象容器
     * @var array
     */
    private static $_models = array();

    /**
     * 获取模型对象
     * @param $modelName
     * @return object
     * @throws \Exception
     */
    public static function get_model($modelName){
        $modelName = __NAMESPACE__ . "\\" . ucfirst($modelName);
        if(!class_exists($modelName)){
            throw new \Exception("{$modelName}类不存在");
        }
        if(!isset(self::$_models[$modelName]) || empty(self::$_models[$modelName])){
            self::$_models[$modelName] = new $modelName();
        }
        return self::$_models[$modelName];
    }
}
