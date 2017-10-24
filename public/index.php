<?php


    $runtime = 'pro';
    define('RUNTIME', $runtime);
    define('ROOT_PATH', dirname(__DIR__));
    define("APP_PATH",ROOT_PATH."/app");
    define("LOG_PATH",ROOT_PATH."/log");

    header('X-Powered-By:member');

try {

    $config = new \Phalcon\Config\Adapter\Php(ROOT_PATH . "/app/config/system/system_{$runtime}.php");
    $modules = (new \Phalcon\Config\Adapter\Php(ROOT_PATH . "/app/config/module.php"))->toArray();
    $cacheServer = (new \Phalcon\Config\Adapter\Php(ROOT_PATH . "/app/config/cache.php"))->toArray();

    include ROOT_PATH . '/app/core/constant.php';

    include ROOT_PATH . '/app/core/loader.php';

    include ROOT_PATH . '/app/ext/predis/autoload.php';

    include ROOT_PATH . '/app/core/services.php';

    include ROOT_PATH . '/app/core/commons.php';

    $application = new \Phalcon\Mvc\Application($di);

    $application -> registerModules($modules);

    echo $application->handle()->getContent();

}catch (\Exception $e) {
    $log = array(
        'file' => $e -> getFile(),
        'line' => $e -> getLine(),
        'code' => $e -> getCode(),
        'msg' => $e -> getMessage(),
        'trace' => $e -> getTraceAsString(),
    );

    $date = date('Ymd');
    $logger = new \Phalcon\Logger\Adapter\File(ROOT_PATH."/app/cache/logs/crash_{$date}.log");
    $logger -> error(json_encode($log));
}





