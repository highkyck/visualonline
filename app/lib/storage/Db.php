<?php

namespace lib\storage;

use Medoo\Medoo;

class Db
{
    public static function instance($dbName)
    {
        $config = \linger\framework\Application::app()->getConfig();

        if (isset($config['db'][$dbName])) {
            $dbConfig = $config['db'][$dbName];
            return new Medoo([
                'database_type' => $dbConfig['type'],
                'database_name' => $dbConfig['name'],
                'server'        => $dbConfig['host'],
                'username'      => $dbConfig['user'],
                'password'      => $dbConfig['pass'],
                'charset'       => $dbConfig['char'],
                'port'          => $dbConfig['port'],
            ]);
        }

        throw new \Exception("the config of {$dbName} is not set.");
    }
}