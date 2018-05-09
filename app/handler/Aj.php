<?php
namespace handler;

use linger\framework\Controller;

class Aj extends Controller
{
    protected function _init()
    {
        $this->getResponse()
            ->header('Content-Type', 'application/json;charset=utf-8');
    }

    public function getList()
    {

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