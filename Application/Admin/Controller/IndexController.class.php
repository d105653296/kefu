<?php
namespace Admin\Controller;
use Think\Controller;

class IndexController extends AdminController {

    

    public function index() {        
        $list=M('menu');
        $nav=$list->where('pid=0 and hide=0')->select();
        $this->assign('nav',$nav);
        
        
        
        //服务器信息
        $info = array(
            'YuTaiCMS版本'=>'1.1.15.01.01',
            '操作系统' => PHP_OS,
            '运行环境' => $_SERVER["SERVER_SOFTWARE"],
            '剩余空间' => round((@disk_free_space(".") / (1024 * 1024)), 2) . 'M',
        );
      
        $this->assign('server_info', $info);
        
        
        $this->display();
    }
    

}