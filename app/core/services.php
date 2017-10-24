<?php

$di = new Phalcon\DI\FactoryDefault();

$di->set('router', function () {
    $router = new \Phalcon\Mvc\Router();
    $router->setDefaultModule('frontend');

    $routerRules = new \Phalcon\Config\Adapter\Php(ROOT_PATH . "/app/config/routers.php");
    foreach ($routerRules->toArray() as $key => $value) {
        $router->add($key, $value);
    }

    return $router;
});


$di->setShared('session', function () use ($config){
//    $session = new Phalcon\Session\Adapter\Files();
    $session = new Phalcon\Session\Adapter\Redis($config->session->toArray());
    $session->start();
    return $session;
});


$di->set('cookies', function () {
    $cookies = new \Phalcon\Http\Response\Cookies();
    $cookies->useEncryption(false);
    return $cookies;
});

$dbconfigs = $config->database->toArray();
foreach ($dbconfigs as $dbName => $options) {
    $di->set($dbName, function () use ($config, $di, $options) {
        $dbconfig = $options;
        if (!is_array($dbconfig) || count($dbconfig) == 0) {
            throw new \Exception("the database config is error");
        }

        if (RUNTIME != 'pro') {
            $eventsManager = new \Phalcon\Events\Manager();
            // 分析底层sql性能，并记录日志
            $profiler = new Phalcon\Db\Profiler();
            $eventsManager->attach('db', function ($event, $connection) use ($profiler, $di) {
                if ($event->getType() == 'beforeQuery') {
                    //在sql发送到数据库前启动分析
                    $profiler->startProfile($connection->getSQLStatement());
                }
                if ($event->getType() == 'afterQuery') {
                    //在sql执行完毕后停止分析
                    $profiler->stopProfile();
                    //获取分析结果
                    $profile = $profiler->getLastProfile();
                    $sql = $profile->getSQLStatement();
                    $params = $connection->getSqlVariables();
                    (is_array($params) && count($params)) && $params = json_encode($params);
                    $executeTime = $profile->getTotalElapsedSeconds();
                    //日志记录
                    $logger = $di->get('logger');
                    $logger->write_log("{$sql} {$params} {$executeTime}", 'debug');
                }
            });
        }

        $connection = new \Phalcon\Db\Adapter\Pdo\Mysql(array(
                "host" => $dbconfig['host'], "port" => $dbconfig['port'],
                "username" => $dbconfig['username'],
                "password" => $dbconfig['password'],
                "dbname" => $dbconfig['dbname'],
                "charset" => $dbconfig['charset'])
        );

//        if(RUNTIME != 'pro') {
//            /* 注册监听事件 */
//            $connection->setEventsManager($eventsManager);
//            /* 注册监听事件 */
//        }

        return $connection;
    });
}


$di->setShared('modelsManager', function () use ($di) {
    $manager = new Phalcon\Mvc\Model\Manager();
    return $manager;
});


$di->setShared('cache', function () use ($config) {
    return new \Phalcon\Cache\Backend\File(new \Phalcon\Cache\Frontend\Output(), array(
        'cacheDir' => $config->app->cache_path
    ));
});


$di->setShared('logger', function () use ($di) {
    $day = date('Ymd');
    $logger = new \Marser\App\Core\PhalBaseLogger(ROOT_PATH . "/app/cache/logs/{$day}.log");
    return $logger;
});


$di->setShared('apiConfig', function () use ($di) {
    $config = \Phalcon\Config\Adapter\Php(ROOT_PATH . '/app/config/api/api_' . RUNTIME . '.php');
    return $config;
});

$di->setShared('systemConfig', function () use ($config) {
    return $config;
});

$di->setShared('validator', function () use ($di) {
    $validator = new \Marser\App\Libs\Validator($di);
    return $validator;
});

$di->setShared('filter', function () use ($di) {
    $filter = new \Marser\App\Core\PhalBaseFilter($di);
    $filter->init();
    return $filter;
});

$di->setShared('email',function()use($di){
    return new Marser\App\Ext\PHPMailer\MailSend();
});

$_sysServer = $cacheServer['redis'];
$_sysPrefix = $_sysServer['prefix'];
unset($_sysServer['prefix']);
foreach ($_sysServer as $_serverName => $option) {
    $di->setShared($_serverName, function () use ($di, $option,$_sysPrefix) {
        $redisServer = new Predis\Client($option, ['prefix' => $_sysPrefix]);
        return $redisServer;
    });
}


