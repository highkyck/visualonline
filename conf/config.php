<?php

return [
    'app_directory'  => APP_PATH . 'app',
    'view_directory' => APP_PATH . 'app/view',
    'log_path'       => '/data/logs/scripts/',
    'ws_server'      => [
        'host' => '127.0.0.1',
        'port' => '9095',
    ],
    'server'         => [
        'ws' => 'wss://ws.im.iliubang.cn:443'
    ],
    'img_path'       => APP_PATH . 'public/data/image/',
    'file_path'      => APP_PATH . 'public/data/file/',
    'db'             => [
        'im_master' => [
            'type' => 'mysql',
            'host' => 'dev.db.iliubang.cn',
            'port' => 3306,
            'user' => 'liubang',
            'pass' => 'liubang',
            'name' => 'im',
            'char' => 'utf8',
        ],
        'im_slave'  => [
            'type' => 'mysql',
            'host' => 'dev.db.iliubang.cn',
            'port' => 3306,
            'user' => 'liubang',
            'pass' => 'liubang',
            'name' => 'im',
            'char' => 'utf8',
        ],
    ],
    'redis'          => [
        'queue'   => [
            'host' => '127.0.0.1',
            'port' => 6379,
            'db'   => 0,
        ],
        'session' => [
            'host' => '127.0.0.1',
            'port' => 6379,
            'db'   => 0,
        ],
    ],
    'session'        => [
        //'gc'     => 86400,
        'domain' => 'iliubang.cn',
    ],
    'site'           => [
        'image' => 'http://im.iliubang.cn',
        'file'  => 'http://im.iliubang.cn',
    ],
];