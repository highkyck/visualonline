<?php

namespace service;

use Medoo\Medoo;

class Base
{
    /**
     * @var Medoo|null
     */
    protected $db = null;

    /**
     * Base constructor.
     * @param Medoo $db
     */
    public function __construct(Medoo $db)
    {
        $this->db = $db;
    }

    protected function success($data = [], $message = '')
    {
        return [
            'code' => 0,
            'data' => $data,
            'msg'  => $message,
        ];
    }

    protected function error($message = '')
    {
        return [
            'code' => 1,
            'data' => [],
            'msg'  => $message,
        ];
    }
}