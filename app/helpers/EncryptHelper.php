<?php

namespace Marser\App\Helpers;

/**
 * Class EncryptHelper
 * @package Marser\App\Helpers
 * @author Bill
 */
class EncryptHelper{

    //TODO::配置化
    private static $_key = "Bill";

    public static function encrypt($string = ""){
        return encrypt($string,self::$_key,'encode');
    }

    public static function decode($string = ""){
        return encrypt($string,self::$_key,'decode');
    }

    public static function smsDecodeEncrypt($string = ''){
        return json_decode(encrypt($string,self::$_key,'decode'));
    }
}