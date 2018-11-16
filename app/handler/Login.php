<?php

namespace handler;

use linger\framework\Controller;

class Login extends Controller
{
    protected function _init()
    {
        if (isset($_SESSION['uid']) && !empty($_SESSION['uid'])) {
            $this->getResponse()->redirect("/");
        }
    }

    /**
     * 登录页面
     */
    public function login()
    {
        $this->getView()
            ->display('login/login.phtml');
    }

    /**
     * 注册页面
     */
    public function reg()
    {
        $this->getView()
            ->display('login/reg.phtml');
    }
}