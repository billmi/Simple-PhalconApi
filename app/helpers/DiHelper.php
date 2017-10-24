<?php

namespace Marser\App\Helpers;

use Phalcon\Di;

/**
 * Class DiHelper
 * @package Marser\App\Helpers
 * @createdBy : Bill
 */
class DiHelper{

    public static function getRedisService($name = ""){
         return Di::getDefault()->getShared($name);
    }

    public static function getSessionService($name = "session"){
        return Di::getDefault()->getShared($name);
    }

    public static function getDataService($name = "db"){
        return Di::getDefault()->getShared($name);
    }
}