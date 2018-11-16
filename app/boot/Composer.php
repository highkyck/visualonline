<?php

namespace boot;

use linger\framework\Application;
use linger\framework\Bootstrap;

class Composer implements Bootstrap
{
    public function bootstrap(Application $app)
    {
        require APP_PATH . 'vendor/autoload.php';
    }
}