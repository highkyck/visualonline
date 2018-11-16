<?php

namespace handler;

use lib\storage\Db;
use linger\framework\Controller;
use service\User;

class Login extends Controller
{
    private static $icons = [
        'https://tva2.sinaimg.cn/crop.0.0.180.180.180/5db11ff4jw1e8qgp5bmzyj2050050aa8.jpg',
        'https://tva3.sinaimg.cn/crop.0.0.512.512.180/8693225ajw8f2rt20ptykj20e80e8weu.jpg',
        'https://tva1.sinaimg.cn/crop.0.0.180.180.180/83d685c5jw1e8qgp5bmzyj2050050aa8.jpg',
        'https://tva1.sinaimg.cn/crop.0.0.180.180.180/7fde8b93jw1e8qgp5bmzyj2050050aa8.jpg',
        'https://tva4.sinaimg.cn/crop.0.0.180.180.180/6a4acad5jw1e8qgp5bmzyj2050050aa8.jpg',
        'https://tva1.sinaimg.cn/crop.0.0.180.180.180/4a02849cjw1e8qgp5bmzyj2050050aa8.jpg',
        'https://tva1.sinaimg.cn/crop.0.0.180.180.180/86b15b6cjw1e8qgp5bmzyj2050050aa8.jpg',
    ];

    private static $defaultGroup = 1;

    protected function _init()
    {
        $this->getView()
            ->setScriptPath(\APP_PATH . 'app/view');

        if (isset($_SESSION['uid']) && !empty($_SESSION['uid'])) {
            header("Location:/");
        }
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
                'avatar'   => self::$icons[array_rand(self::$icons, 1)],
                'sign'     => '测试用户',
                'email'    => $email,
                'passwd'   => self::hashPasswd($passwd),
                'reg_time' => time(),
            ];

            $users = $db->select('user', '*', [
                'OR' => [
                    'username' => $username,
                    'email'    => $email,
                ],
            ]);

            if (!empty($users)) {
                $this->_response->json([
                    'status' => 1,
                    'data'   => '',
                    'msg'    => '用户昵称或邮箱已经被使用',
                ])->send();
            }

            $db->insert('user', $user);
            $uid = $db->id();
            // 默认将用户加入测试群组中

            $db->insert('group_user_map', [
                'group_id' => self::$defaultGroup,
                'uid'      => $uid,
            ]);

            $db->insert('user_group_map', [
                'group_id' => self::$defaultGroup,
                'uid'      => $uid,
            ]);

            $this->_response->status(200)
                ->json([
                    'status' => 0,
                    'data'   => '',
                    'msg'    => '注册成功',
                ])->send();
        } else {
            $this->getView()
                ->display('login/reg.phtml');
        }
    }
}