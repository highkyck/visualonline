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
            'host' => '192.168.8.11',
            'port' => 3306,
            'user' => 'liubang',
            'pass' => 'liubang',
            'name' => 'im',
        ],
        'im_slave'  => [
            'host' => '192.168.8.11',
            'port' => 3306,
            'user' => 'liubang',
            'pass' => 'liubang',
            'name' => 'im',
        ],
    ],
];