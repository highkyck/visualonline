<?php

return [
    'app_directory'  => APP_PATH . 'app',
    'view_directory' => APP_PATH . 'app/view',
    'log_path'       => '/data/logs/scripts/',
    'ws_server'      => [
        'host' => '0.0.0.0',
        'port' => '9095',
    ],
    'server'         => [
        'ws' => 'ws://ws.im.iliubang.cn:80'
    ],
    'img_path'       => APP_PATH . 'public/data/image/',
    'file_path'      => APP_PATH . 'public/data/file/',
    'db'             => [
        'im_master' => [
            'type' => 'mysql',
            'host' => 'percona',
            'port' => 3306,
            'user' => 'im',
            'pass' => 'im',
            'name' => 'im',
            'char' => 'utf8',
        ],
        'im_slave'  => [
            'type' => 'mysql',
            'host' => 'percona',
            'port' => 3306,
            'user' => 'im',
            'pass' => 'im',
            'name' => 'im',
            'char' => 'utf8',
        ],
    ],
    'redis'          => [
        'queue'   => [
            'host' => 'redis',
            'port' => 6379,
            'db'   => 0,
        ],
        'session' => [
            'host' => 'redis',
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