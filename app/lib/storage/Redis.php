<?php

namespace lib\storage;

use linger\framework\Application;

class Redis
{
    public static function instance($redis)
    {
        $config = Application::app()->getConfig();

        if (isset($config['redis'][$redis])) {
            $redisConfig = $config['redis'][$redis];
            $r = new \Redis();
            $r->connect($redisConfig['host'], $redisConfig['port']);
            $r->select($redisConfig['db']);

            return $r;
        }

        throw new \Exception("the config of {$redis} is not set.");
    }
}