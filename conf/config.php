<?php

return [
    'app_directory' => APP_PATH . 'app',
    'log_path'      => '/data/logs/scripts/',
    'ws_server'     => [
        'host' => 'dev.ws.iliubang.cn',
        'port' => '9501',
    ],
    'img_path'      => APP_PATH . 'public/data/image/',
    'file_path'     => APP_PATH . 'public/data/file/',
    'db'            => [
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
    'redis'         => [
        'queue' => [
            'host' => '127.0.0.1',
            'port' => 6379,
            'db'   => 0,
        ],
    ],
    'site'          => [
        'image' => 'http://im.iliubang.cn',
        'file'  => 'http://im.iliubang.cn',
    ],
];