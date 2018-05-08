<?php

namespace boot;

use linger\framework\Application;
use linger\framework\Bootstrap;

class Session implements Bootstrap
{
    public function bootstrap(Application $application)
    {
        \session_start();
    }

}