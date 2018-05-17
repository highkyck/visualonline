<?php

namespace boot;

use linger\framework\Application;
use linger\framework\Bootstrap;

class Session implements Bootstrap
{
    public function bootstrap(Application $application)
    {
        $config = $application->getConfig();
        ini_set('session.save_handler', 'redis');
        ini_set('session.serialize_handler', 'php_serialize');
        ini_set('session.save_path',
            'tcp://' . $config['redis']['session']['host'] . ':' . $config['redis']['session']['port']);
        // 不适用GET/POST变量方式
        ini_set('session.use_trans_sid', 0);
        //设置垃圾回收最大生存时间
        if (isset($config['session']['gc'])) {
            ini_set('session.gc_maxlifetime', $config['session']['gc']);
        }
        //使用 COOKIE 保存 SESSION ID 的方式
        ini_set('session.use_cookies', 1);
        ini_set('session.cookie_path', '/');
        //多主机共享保存 SESSION ID 的 COOKIE
        ini_set('session.cookie_domain', $config['session']['domain']);
        \session_start();
    }
}