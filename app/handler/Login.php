<?php

namespace handler;

use lib\storage\Db;
use linger\framework\Controller;
use service\User;

class Login extends Controller
{

    private static $icons = [
        'http://tp1.sinaimg.cn/1571889140/180/40030060651/1',
        'http://tva3.sinaimg.cn/crop.0.0.512.512.180/8693225ajw8f2rt20ptykj20e80e8weu.jpg',
        'http://tp2.sinaimg.cn/1833062053/180/5643591594/0',
        'http://tp4.sinaimg.cn/2145291155/180/5601307179/1',
        'http://tp2.sinaimg.cn/1783286485/180/5677568891/1',
        'http://tp1.sinaimg.cn/1241679004/180/5743814375/0',
        'http://tva1.sinaimg.cn/crop.0.0.180.180.180/86b15b6cjw1e8qgp5bmzyj2050050aa8.jpg',
        'http://tp1.sinaimg.cn/5286730964/50/5745125631/0',
        'http://tp4.sinaimg.cn/1665074831/180/5617130952/0',
        'http://tp2.sinaimg.cn/2518326245/180/5636099025/0',
        'http://tp3.sinaimg.cn/1223762662/180/5741707953/0',
        'http://tp4.sinaimg.cn/1345566427/180/5730976522/0',
    ];

    protected function _init()
    {
        $this->getView()
            ->setScriptPath(\APP_PATH . 'app/view');
    }

    private static function hashPasswd($pass)
    {
        return \md5($pass . SALT);
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
            if (self::hashPasswd($passw) === $userInfo['passwd']) {
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
            $db = Db::instance("im_master");

            $user = [
                'username' => $username,
                'avatar'   => array_rand(self::$icons, 1),
                'sign'     => '测试用户',
                'email'    => $email,
                'passwd'   => self::hashPasswd($passwd),
                'reg_time' => time(),
            ];

            $users = $db->select('user', '*', [
                'OR' => [
                    'username' => $username,
                    'email'    => $email
                ]
            ]);

            if (!empty($users)) {
                $this->_response->json([
                    'status' => 1,
                    'data'   => '',
                    'msg'    => '用户昵称或邮箱已经被使用'
                ])->send();

                return false;
            }

            $db->insert('user', $user);

            $this->_response->json([
                'status' => 0,
                'data'   => '',
                'msg'    => '注册成功'
            ])->send();
        } else {
            $this->getView()
                ->display('login/reg.phtml');
        }
    }
}