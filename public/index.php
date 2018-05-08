<?php
define('APP_PATH', realpath(__DIR__ . '/../') . '/');
require APP_PATH . 'vendor/autoload.php';

$bootclass = [
    \boot\Error::class,
    \boot\Session::class,
    \boot\Router::class,
];

$app = new linger\framework\Application(require APP_PATH . '/conf/config.php');
$app->init($bootclass)
    ->run();