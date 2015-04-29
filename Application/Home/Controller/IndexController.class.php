<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
        $this->display();
    }
    public function login(){
        if($_POST){
            $data=$_POST[data];
            $_SESSION[username]=$data[username];
            $data[password]=  md5($_POST[password]);
            $where=array('username'=>$data[username]);
            $result=M('member')->where($where)->find();
            if($result){
                if($data[password]==$result[password]){
                    $_SESSION[id]=$result[id];
                    $this->success('登录成功！',U('User/newsindex'));
                }else{
                    $this->error('密码错误！');
                }
            }else{
                $this->error('用户名错误！');
            }
        }
    }

    public function register(){
        if($_POST){
            $data=$_POST[data];
            if(empty($data[username])){$this->error('用户名不能为空！');}
            if(empty($data[password])){$this->error('密码不能为空！');}
            if($data[password]!=$data[password2]){$this->error("两次输入密码不一致");}
            $data[group_id]=2;
            $data[reg_time]=  time();
            $data[password]=  md5($data[password]);
          if($_POST[is]==1){
                $result=M('member')->add($data);
                if($result){
                    $this->success('注册成功！',U('Index/index'));
                }else{
                    $this->error('请认真填写！');
                }
            }else{
                $this->error('未同意会员注册条款！');
            }
        }
        $this->display();
    }

    public function outout() {

    }
}