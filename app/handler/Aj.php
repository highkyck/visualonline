<?php
namespace handler;

use lib\storage\Db;
use linger\framework\Controller;
use service\User;

class Aj extends Controller
{
    protected function _init()
    {
        $this->getResponse()
            ->header('Content-Type', 'application/json;charset=utf-8');
        $_SESSION['uid'] = 1;
    }

    public function getList()
    {
        $db = Db::instance('im_slave');
        $service = new User($db);
        $result = $service->getList($_SESSION['uid']);
        $this->getResponse()->json($result)->send();
    }

    public function getMembers()
    {

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