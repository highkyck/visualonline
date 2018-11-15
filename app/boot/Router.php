<?php

namespace boot;

use handler\Aj;
use handler\Index;
use handler\Login;
use linger\framework\Application;
use linger\framework\Bootstrap;

class Router implements Bootstrap
{
    public function bootstrap(Application $application)
    {
        $application->getRouter()
            ->get('/', Index::class, 'index')
            ->get('/m', Index::class, 'mobile')
            ->get('/login', Login::class, 'login')
            ->post('/login', Login::class, 'login')
            ->get('/reg', Login::class, 'reg')
            ->post('/reg', Login::class, 'reg')
            ->get('/aj/getList', Aj::class, 'getList')
            ->get('/aj/getMembers', Aj::class, 'getMembers')
            ->get('/aj/getUserStatus', Aj::class, 'getUserStatus')
            ->get('/aj/getMessage', Aj::class, 'getMessage')
            ->get('/aj/clearAllUnpushed', Aj::class, 'clearAllUnpushed')
            ->post('/aj/changeMyStatus', Aj::class, 'changeMyStatus')
            ->post('/aj/changeSign', Aj::class, 'changeSign')
            ->post('/aj/upload/image', Aj::class, 'uploadImg')
            ->post('/aj/upload/file', Aj::class, 'uploadFile');
    }
}