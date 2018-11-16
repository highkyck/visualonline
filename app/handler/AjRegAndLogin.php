<?php

namespace handler;

use lib\storage\Db;
use linger\framework\Controller;
use service\User;

class AjRegAndLogin extends Controller
{
    protected function _init()
    {

    }

    public function login()
    {
        $email = $this->_request->getPost('email', '', 'trim');
        $passw = $this->_request->getPost('passwd', '', 'trim');
        if (empty($email) || empty($passw)) {
            $this->getResponse()
                ->json([
                    'code' => '403',
                    'data' => '',
                    '参数错误'
                ])
                ->send();
        }

        $user = new User(Db::instance('im_slave'));
        $userInfo = $user->getUserInfoByEmail($email);
        if (empty($userInfo)) {
            $this->getResponse()
                ->json([
                    'code' => '404',
                    'data' => '',
                    'msg'  => '用户不存在'
                ])
                ->send();
        }

        if (User::hashPasswd($passw) === $userInfo['passwd']) {
            $_SESSION = $userInfo;
            $_SESSION['uid'] = $userInfo['id'];
            $this->getResponse()
                ->json([
                    'code' => '0',
                    'data' => '',
                    'msg'  => '登录成功'
                ]);
        } else {
            $this->getResponse()
                ->json([
                    'code' => '403',
                    'data' => '',
                    'msg'  => '邮箱或密码错误'
                ]);
        }
    }

    public function reg()
    {
        $username = $this->_request->getPost('username', '', 'trim');
        $email = $this->_request->getPost('email', '', 'trim');
        $passwd = $this->_request->getPost('passwd', '', 'trim');

        $user = [
            'username' => $username,
            'sign'     => '测试用户',
            'email'    => $email,
            'passwd'   => User::hashPasswd($passwd),
            'reg_time' => time(),
        ];

        $userModel = new User(Db::instance("im_master"));
        $result = $userModel->regForTest($user);

        $this->getResponse()
            ->status(200)
            ->json($result)
            ->send();
    }
}