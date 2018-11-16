<?php

namespace boot;

use lib\log\Logger;
use linger\framework\Application;
use linger\framework\Bootstrap;

class Error implements Bootstrap
{
    public function bootstrap(Application $application)
    {
        Logger::setPath($application->getConfig()->get('log_path') . date('Y/md/'));

        \set_exception_handler(function($exception) {
            Logger::error("exception.log", $exception->__toString());
        });

        \register_shutdown_function(function() {
            $error = error_clear_last();
            Logger::error("error.log", json_decode($error));
            Logger::land();
        });
    }

}