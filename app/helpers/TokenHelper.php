<?php


namespace Marser\App\Helpers;

class TokenHelper{

    private static $_key = "user_token";

    public static function creatToken($data){
        return encrypt(json_encode($data,JSON_UNESCAPED_UNICODE),self::$_key);
    }

    public static function checkToken($data){
        return encrypt(json_decode($data,true),self::$_key,'decode');
    }
}