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
        $userId = $this->getRequest()
            ->getQuery('userId', 100000, 'intval');

        $this->getView()
            ->assign('userId', $userId)
            ->display('index/index.phtml');
    }

    public function mobile()
    {
        $this->getView()
            ->display('index/mobile.phtml');
    }
}