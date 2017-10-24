<?php


namespace Marser\App\Core;

class PhalBaseLogger extends \Phalcon\Logger\Adapter\File{

    /**
     * 日志记录
     * @param $log
     * @param $level 日志等级
     * @link https://docs.phalconphp.com/zh/latest/reference/logging.html
     */
    public function write_log($log, $level='error'){
        is_array($log) && $log = json_encode($log);

        empty($level) && $level = 'error';
        $level = strtolower($level);
        $this -> $level($log);

        $text ='[' . date('Y-m-d h:i:s',time()) . '][' . $level .']'. $log . "\n";
        $file = LOG_PATH .'/sql/'.date('Ymd').'.log';
        file_put_contents($file, $text, FILE_APPEND);
    }

}