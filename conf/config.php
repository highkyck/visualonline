<?php

return [
    'app_directory' => APP_PATH . 'app',
    'log_path'      => '/data/logs/scripts/',
    'ws_server'     => [
        'host' => '192.168.8.11',
        'port' => '9501',
    ],
    'db'            => [
        'im_master' => [
            'type' => 'mysql',
            'host' => '192.168.8.11',
            'port' => 3306,
            'user' => 'liubang',
            'pass' => 'liubang',
            'name' => 'im',
            'char' => 'utf8',
        ],
        'im_slave'  => [
            'type' => 'mysql',
            'host' => '192.168.8.11',
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
];