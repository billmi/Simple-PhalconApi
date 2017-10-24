<?php

namespace Marser\App\Core;

use Marser\App\Frontend\Repositories\RepositoryFactory;

class PhalBaseController extends \Phalcon\Mvc\Controller {

    public function initialize(){

    }

    /**
     * ajax输出
     * @param $message
     * @param int $code
     * @param array $data
     * @author Marser
     */
    protected function ajax_return($message, $code=1, array $data=array()){
        $result = array(
            'code' => $code,
            'message' => $message,
            'data' => $data,
        );
        //$this -> response -> setContent(json_encode($result));
        $this -> response -> setJsonContent($result);
        $this -> response -> send();
    }

    /**
     * exception日志记录
     * @param \Exception $e
     * @author Marser
     */
    protected function write_exception_log(\Exception $e){
        $logArray = array(
            'file' => $e -> getFile(),
            'line' => $e -> getLine(),
            'code' => $e -> getCode(),
            'message' => $e -> getMessage(),
            'trace' => $e -> getTraceAsString(),
        );
        $this -> logger -> write_log($logArray);
    }

    /**
     * 文件日志
     * outputLog
     * @param $file
     * @param $text
     * @param int $level
     * @author Bill
     */
    public static function outputLog($file, $text , $level = 0)
    {
        $text ='[' . date('Y-m-d h:i:s',time()) . '][' . $level .']'. $text . "\n";
        $file = LOG_PATH .'/log/'.$file.'_'.date('Ymd').'.log';
        file_put_contents($file, $text, FILE_APPEND);
    }

    /**
     * 获取业务对象
     * @param $repositoryName
     * @return object
     * @throws \Exception
     */
    protected function get_repository($repositoryName){
        return RepositoryFactory::get_repository($repositoryName);
    }
}