<?php



return array(
    'app' => array(
        //项目名称
        'app_name' => 'Phalcon',

        //版本号
        'version' => '1.0',

        //根命名空间
        'root_namespace' => 'Marser',

        //前台配置
        'frontend' => array(
            //模块在URL中的pathinfo路径名
            'module_pathinfo' => '/',

            //控制器路径
            'controllers' => ROOT_PATH . '/app/frontend/controllers/',

            //视图路径
            'views' => ROOT_PATH . '/app/frontend/views/',

            //是否实时编译模板
            'is_compiled' => true,

            //模板路径
            'compiled_path' => ROOT_PATH . '/app/cache/compiled/frontend/',

            //前台静态资源URL
            'assets_url' => '/home/',
        ),

        //后台配置
        'backend' => array(
            //模块在URL中的pathinfo路径名
            'module_pathinfo' => '/admin/',

            //控制器路径
            'controllers' => ROOT_PATH . '/app/backend/controllers/',

            //视图路径
            'views' => ROOT_PATH . '/app/backend/views/',

            //是否实时编译模板
            'is_compiled' => true,

            //模板路径
            'compiled_path' => ROOT_PATH . '/app/cache/compiled/backend/',

            //后台静态资源URL
            'assets_url' => '/admin/',
        ),

        //后台配置
        'backend' => array(
            //模块在URL中的pathinfo路径名
            'module_pathinfo' => '/admin/',

            //控制器路径
            'controllers' => ROOT_PATH . '/app/backend/controllers/',

            //视图路径
            'views' => ROOT_PATH . '/app/backend/views/',

            //是否实时编译模板
            'is_compiled' => true,

            //模板路径
            'compiled_path' => ROOT_PATH . '/app/cache/compiled/backend/',

            //后台静态资源URL
            'assets_url' => '/admin/',
        ),

        //类库路径
        'libs' => ROOT_PATH . '/app/libs/',

        //日志根目录
        'log_path' => ROOT_PATH . '/app/cache/logs/',

        //缓存路径
        'cache_path' => ROOT_PATH . '/app/cache/data/',
    ),

    //数据库表配置
    'database' => array(
        //数据库连接信息
        'db' => array(
            'host' => '127.0.0.1',
            'port' => 3306,
            'username' => 'root',
            'password' => 'root',
            'dbname' => 'phalapi',
            'charset' => 'utf8',
        ),
//        'db1' => array(
//            'host' => '127.0.0.1',
//            'port' => 3306,
//            'username' => 'root',
//            'password' => 'root',
//            'dbname' => 'p2p',
//            'charset' => 'utf8',
//        ),
//        'db2' => array(
//            'host' => '127.0.0.1',
//            'port' => 3306,
//            'username' => 'root',
//            'password' => 'root',
//            'dbname' => 'p2p',
//            'charset' => 'utf8',
//        ),
        //表前缀
        'prefix' => '',
    ),

    'session' => [
        "uniqueId"   => "B0DEC9A594210EF20763734ED14313FB",  // starchain MD5
        "host"       => "192.168.0.200",
        "port"       => 6380,
//            "auth"       => "foobared",
        "persistent" => false,
        "lifetime"   => 7200,
        "prefix"     => "session_",
        "index"      => 15,
    ]
);