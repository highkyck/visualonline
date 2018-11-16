<?php

namespace handler;

use lib\storage\Db;
use lib\storage\Redis;
use linger\framework\Application;
use linger\framework\Controller;
use service\Message;
use service\User;

class AjOp extends Controller
{
    protected function _init()
    {
        $this->getResponse()
            ->header('Content-Type', 'application/json;charset=utf-8');
        if (empty($_SESSION['uid'])) {
            $this->getResponse()
                ->status(403)
                ->json(['code' => 403, 'msg' => '请登录', 'data' => ''])
                ->send();
        }
    }

    public function changeSign()
    {
        $sign = $this->getRequest()->getPost('sign', '', 'trim');
        try {
            $db = Db::instance('im_master');
            $user = new User($db);
            $user->changeSign($_SESSION['uid'], $sign);
            $this->getResponse()
                ->json(['code' => 0, 'data' => '', 'msg' => ''])
                ->send();
        } catch (\Exception $exception) {
            echo $exception;
        }
    }

    public function getMessage()
    {
        try {
            $db = Db::instance('im_slave');
            $message = new Message($db);
            $res = $message->getUnPushedMessage($_SESSION['uid']);
            $this->getResponse()
                ->json(['code' => 0, 'data' => $res, 'msg' => ''])
                ->send();
        } catch (\Exception $exception) {
            echo $exception;
        }
    }

    public function clearAllUnpushed()
    {
        try {
            $db = Db::instance('im_master');
            $message = new Message($db);
            $res = $message->clearAllUnpushed($_SESSION['uid']);
            $this->getResponse()
                ->json(['code' => 0, 'data' => $res, 'msg' => ''])
                ->send();
        } catch (\Exception $exception) {
            echo $exception;
        }
    }

    public function getList()
    {
        try {
            $db = Db::instance('im_slave');
            $service = new User($db);
            $list = $service->getList($_SESSION['uid']);
            $this->getResponse()->json(['code' => 0, 'data' => $list, 'msg' => ''])->send();
        } catch (\Exception $exception) {
            echo $exception;
        }

    }

    public function getMembers()
    {
        try {
            $groupId = $this->getRequest()->getQuery('id', 0, 'intval');
            if (!$groupId) {
                $result = ['code' => 1000, 'msg' => '参数错误', 'data' => ''];
            } else {
                $db = Db::instance('im_slave');
                $service = new User($db);
                // TODO 校验当前用户是否有获取该群的权限
                $list = $service->getMembers($groupId);
                $result = ['code' => 0, 'msg' => '', 'data' => $list];
            }
            $this->getResponse()->json($result)->send();
        } catch (\Exception $exception) {
            echo $exception;
        }
    }

    public function getUserStatus()
    {
        $uid = $this->getRequest()->getQuery('id', 0, 'intval');
        $result = ['code' => 0, 'data' => 0, 'msg' => ''];
        if ($uid > 0) {
            try {
                $redis = Redis::instance('queue');
                $userInfo = $redis->hGet('user_info', $uid);
                $userInfo = \json_decode($userInfo, true);
                if (!empty($userInfo)) {
                    $result = ['code' => 0, 'data' => $userInfo['status'], 'msg' => ''];
                }
            } catch (\Exception $exception) {
                echo $exception;
            }
        }
        $this->getResponse()->json($result)->send();
    }

    public function changeMyStatus()
    {
        $status = $this->getRequest()->getPost('status', 'hide', 'trim');
        $result = ['code' => 0, 'data' => 0, 'msg' => ''];
        try {
            $redis = Redis::instance('queue');
            $userInfo = $redis->hGet('user_info', $_SESSION['uid']);
            $userInfo = \json_decode($userInfo, true);
            if (!empty($userInfo)) {
                $userInfo['status'] = $status;
                $redis->hSet('user_info', $_SESSION['uid'], \json_encode($userInfo));
                $result = ['code' => 0, 'data' => 1, 'msg' => ''];
            }
        } catch (\Exception $exception) {
            echo $exception;
        }

        $this->getResponse()->json($result)->send();
    }

    public function uploadImg()
    {
        $file = $this->getRequest()->getFile('file');
        if (!empty($file) && isset($file['tmp_name'])) {
            $ext = strrchr($file['name'], '.');
            $config = Application::app()->getConfig();
            $distPath = $config['img_path'] . \date('Y/md/');
            $dist = $distPath . \md5($file['name'] . \time()) . $ext;
            if (!\is_dir($distPath)) {
                \mkdir($distPath, 0777, true);
            }
            \move_uploaded_file($file['tmp_name'], $dist);
            $this->getResponse()
                ->json([
                    'code' => 0,
                    'msg'  => '',
                    'data' => ['src' => $config['site']['image'] . \str_replace(\APP_PATH . 'public', '', $dist)],
                ])
                ->send();
        }
    }

    public function uploadFile()
    {
        $file = $this->getRequest()->getFile('file');
        if (!empty($file) && isset($file['tmp_name'])) {
            $ext = strrchr($file['name'], '.');
            $config = Application::app()->getConfig();
            $distPath = $config['file_path'] . \date('Y/md/');
            $dist = $distPath . \md5($file['name'] . \time()) . $ext;
            if (!\is_dir($distPath)) {
                \mkdir($distPath, 0777, true);
            }
            \move_uploaded_file($file['tmp_name'], $dist);
            $this->getResponse()
                ->json([
                    'code' => 0,
                    'msg'  => '',
                    'data' => ['src' => $config['site']['file'] . \str_replace(\APP_PATH . 'public', '', $dist)],
                ])
                ->send();
        }
    }
}