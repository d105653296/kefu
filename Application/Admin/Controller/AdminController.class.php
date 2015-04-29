<?php

namespace Admin\Controller;
use Think\Controller;

/**
 * 后台首页控制器

 */
class AdminController extends Controller {
    /**
     * 后台控制器初始化
     */
    protected function _initialize(){
        header("Content-Type:text/html; charset=utf-8");
         $user = $_SESSION['username'];
        if (empty($user)) {
            $this->redirect('public/login');
        }
    }
}
