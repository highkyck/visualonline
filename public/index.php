<?php

use linger\framework\Application;

define('APP_PATH', realpath(__DIR__ . '/../') . '/');

require APP_PATH . 'vendor/autoload.php';
$config = require APP_PATH . '/conf/config.php';

$app = new Application($config);
$app->init([
    \boot\Error::class,
    \boot\Session::class,
    \boot\Router::class,
])->run();