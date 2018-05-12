<?php
namespace handler;

use linger\framework\Controller;

class Index extends Controller
{
    public function _init()
    {
        $_SESSION['uid'] = $this->getRequest()->getQuery('uid', 1, 'intval');
        $this->getView()
            ->setScriptPath(\APP_PATH . 'app/view');
    }

    public function index()
    {
        $userId = $this->getRequest()
            ->getQuery('userId', $_SESSION['uid'], 'intval');

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