<?php

namespace handler;

use lib\storage\Db;
use linger\framework\Controller;
use service\User;

class Login extends Controller
{
    protected function _init()
    {
        $this->getView()
            ->setScriptPath(\APP_PATH . 'app/view');
    }

    public function login()
    {
        $request = $this->getRequest();
        if ($request->isPost()) {
            $email = $request->getPost('email', '', 'trim');
            $passw = $request->getPost('passwd', '', 'trim');
            if (empty($email) || empty($passw)) {
                \header("Location:/login");
            }
            $db = Db::instance('im_slave');
            $user = new User($db);
            $userInfo = $user->getUserInfoByEmail($email);
            if (empty($userInfo)) {
                \header("Location:/login");
            }
            if (\md5($passw . SALT) === $userInfo['passwd']) {
                $_SESSION = $userInfo;
                $_SESSION['uid'] = $userInfo['id'];
                \header("Location:/");
            }
        } else {
            $this->getView()
                ->display('login/login.phtml');
        }
    }

    public function reg()
    {
        if ($this->_request->isPost()) {
            $username = $this->_request->getPost('username', '', 'trim');
            $email = $this->_request->getPost('email', '', 'trim');
            $passwd = $this->_request->getPost('passwd', '', 'trim');

        } else {
            $this->getView()
                ->display('login/reg.phtml');
        }
    }
}