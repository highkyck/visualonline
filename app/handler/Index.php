<?php
namespace handler;

use linger\framework\Controller;

class Index extends Controller
{
    public function _init()
    {
        $this->getResponse()
            ->header('Content-Type', 'application/json;charset=utf-8');
    }

}