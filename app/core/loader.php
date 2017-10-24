<?php

$loader = new \Phalcon\Loader();

$loader -> registerNamespaces(array(
    'Marser' => ROOT_PATH,

    'Marser\App\Core' => ROOT_PATH . '/app/core',
    'Marser\App\Helpers' => ROOT_PATH . '/app/helpers',
    'Marser\App\Libs' => ROOT_PATH . '/app/libs',
    'Marser\App\Service' => ROOT_PATH . '/app/service',
    'Marser\App\Tasks' => ROOT_PATH . '/app/tasks',
    'Marser\App\Ext' => ROOT_PATH . '/app/ext',
    'Marser\App\Response' => ROOT_PATH . '/app/response',
    'Marser\App\Interceptor' => ROOT_PATH . '/app/interceptor',
    'Marser\App\Common\Base' => ROOT_PATH . '/app/common/base',

    'Marser\App\Frontend\Controllers' => ROOT_PATH . '/app/frontend/controllers',
    'Marser\App\Frontend\Models' => ROOT_PATH . '/app/frontend/models',
    'Marser\App\Frontend\Repositories' => ROOT_PATH . '/app/frontend/repositories',

    'Marser\App\Backend\Controllers' => ROOT_PATH . '/app/backend/controllers',
    'Marser\App\Backend\Models' => ROOT_PATH . '/app/backend/models',
    'Marser\App\Backend\Repositories' => ROOT_PATH . '/app/backend/repositories',
)) -> register();