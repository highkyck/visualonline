<?php

namespace boot;

use lib\log\Logger;
use linger\framework\Application;
use linger\framework\Bootstrap;

class Error implements Bootstrap
{
    public function bootstrap(Application $application)
    {
        Logger::setPath($application->getConfig()->get('log_path'));

        \set_exception_handler(function($exception) {
            Logger::error("exception.log", $exception->__toString());
        });

        \register_shutdown_function(function() {
            Logger::land();
        });
    }

}