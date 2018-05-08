<?php
namespace handler;

use linger\framework\Controller;

class Aj extends Controller
{
    protected function _init()
    {
        if (!$this->getRequest()->isAjax()) {
            $this->getResponse()
                ->status(403)
                ->body("非法请求")
                ->send();
        }
        $this->getResponse()
            ->header('Content-Type', 'application/json;charset=utf-8');
    }

    public function index()
    {
        $this->getResponse()
            ->json(['status' => 1, 'data' => 'ok'])
            ->send();
    }
}