<?php

namespace boot;

use handler\Aj;
use handler\Index;
use linger\framework\Application;
use linger\framework\Bootstrap;

class Router implements Bootstrap
{
    public function bootstrap(Application $application)
    {
        $application->getRouter()
            ->get('/', Index::class, 'index')
            ->get('/m', Index::class, 'mobile')
            ->get('/aj/index', Aj::class, 'index');
    }
}