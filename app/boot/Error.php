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

        \set_exception_handler(function(\Exception $exception) {
            Logger::error("exception.log", $exception->getMessage() . "\n" . $exception->getTraceAsString());
        });

        \register_shutdown_function(function() {
            Logger::land();
        });
    }

}