<?php

namespace Marser\App\Service;

use Marser\App\Helpers\DiHelper;

class RedisService{

   static function cache($name,$value='',$options = null,$serviceName = 'r1') {
        $cache = DiHelper::getRedisService($serviceName);
        if(''=== $value){
            return $cache->get($name);
        }elseif(is_null($value)) {
            return $cache->rm($name);
        }else {
            if(is_array($options)) {
                $expire     =   isset($options['expire'])?$options['expire']:NULL;
            }else{
                $expire     =   is_numeric($options)?$options:NULL;
            }
            if($expire)
                return $cache->set($name, $value) && $cache->expire($name,$expire);
            return $cache->set($name, $value);
        }
    }


}
