<?php
namespace handler;

use linger\framework\Controller;

class Index extends Controller
{
    public function _init()
    {
        $this->getView()
            ->setScriptPath(\APP_PATH . 'app/view');
    }

    public function index()
    {
        $this->getView()
            ->display('index/index.phtml');
    }

    public function mobile()
    {
        $this->getView()
            ->display('index/mobile.phtml');
    }
}