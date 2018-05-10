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
}