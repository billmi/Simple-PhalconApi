<?php


return [
    'redis' => [
        'r1'=>[
            'host' => '127.0.0.1',
            'port' => 6380,
//            "auth"       => "KoP#ie_01",
            'database' => 1,
        ],
        'r2'=>[
            'host' => '127.0.0.1',
            'port' => 6381,
//            "auth"       => "KoP#ie_01",
            'database' => 2,
        ],
        'prefix' => 'member:',
    ]
];