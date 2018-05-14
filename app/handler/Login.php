<?php
namespace handler;

use linger\framework\Controller;

class Login extends Controller
{
    protected function _init()
    {
        $this->getView()
            ->setScriptPath(\APP_PATH . 'app/view');
    }

    public function login()
    {
        $this->getView()
            ->display('login/login.phtml');
    }

    public function reg()
    {
        $this->getView()
            ->display('login/reg.phtml');
    }
}