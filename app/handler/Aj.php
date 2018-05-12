<?php

namespace handler;

use lib\storage\Db;
use linger\framework\Controller;
use service\User;

class Aj extends Controller
{
    protected function _init()
    {
        $_SESSION['uid'] = 1;
        $this->getResponse()
            ->header('Content-Type', 'application/json;charset=utf-8');
        $_SESSION['uid'] = 1;
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
                $list = $service->getMembers($_SESSION['uid']);
                $result = ['code' => 0, 'msg' => '', 'data' => $list];
            }
            $this->getResponse()->json($result)->send();
        } catch (\Exception $exception) {
            echo $exception;
        }
    }

    public function uploadImg()
    {
        $this->getResponse()
            ->json(['code' => 0, 'msg' => '', 'data' => ['src' => 'http://tp4.sinaimg.cn/2145291155/180/5601307179/1']])
            ->send();
    }

    public function uploadFile()
    {
        $this->getResponse()
            ->json(['code' => 0, 'msg' => '', 'data' => ['src' => 'http://tp4.sinaimg.cn/2145291155/180/5601307179/1']])
            ->send();
    }
}