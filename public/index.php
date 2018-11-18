<?php

use linger\framework\Application;

ini_set('display_errors', 0);
error_reporting(E_ERROR & ~E_NOTICE);
define('APP_PATH', realpath(__DIR__ . '/../') . '/');
define("SALT", "BIGBANG_WEBIM");

$env = getenv('PHP_ENV');
if (false !== $env && $env === 'dev') {
    $config = require APP_PATH . '/conf/config.dev.php';
} else {
    $config = require APP_PATH . '/conf/config.php';
}

$app = new Application($config);
$app->init([
    \boot\Composer::class,
    \boot\Error::class,
    \boot\Session::class,
    \boot\Router::class,
])->run();