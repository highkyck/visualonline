<?php

namespace boot;

use handler\AjOp;
use handler\AjRegAndLogin;
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
            ->get('/reg', Login::class, 'reg')
            ->post('/aj/login', AjRegAndLogin::class, 'login')
            ->post('/aj/reg', AjRegAndLogin::class, 'reg')
            ->get('/aj/getList', AjOp::class, 'getList')
            ->get('/aj/getMembers', AjOp::class, 'getMembers')
            ->get('/aj/getUserStatus', AjOp::class, 'getUserStatus')
            ->get('/aj/getMessage', AjOp::class, 'getMessage')
            ->get('/aj/clearAllUnpushed', AjOp::class, 'clearAllUnpushed')
            ->post('/aj/changeMyStatus', AjOp::class, 'changeMyStatus')
            ->post('/aj/changeSign', AjOp::class, 'changeSign')
            ->post('/aj/upload/image', AjOp::class, 'uploadImg')
            ->post('/aj/upload/file', AjOp::class, 'uploadFile');
    }
}