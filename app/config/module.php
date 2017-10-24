<?php

return [
    'frontend' => array(
        'className' => 'Marser\App\Frontend\FrontendModule',
        'path' => ROOT_PATH . '/app/frontend/FrontendModule.php',
    ),
    'backend' => array(
        'className' => 'Marser\App\Backend\BackendModule',
        'path' => ROOT_PATH . '/app/backend/BackendModule.php',
    ),
];