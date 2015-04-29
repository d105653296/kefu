<?php

namespace Admin\Controller;

use Think\Controller;

class UserController extends AdminController {


    public function Gradeupdate() {

       $id=$_POST['id'];
       if(!empty($id)){

           $data[id]=$id;
           $data[grade]=$_POST['val'];
            $result = M("member")->save($data);

       }
    }
    public function index() {
        $res=M('group')->select();
        $this->assign('res',$res);
        if($_POST){
            $name=$_POST[name];
            $list = M("member");
            $where[username]=array('like','%'.$name.'%');
            $count = $list->where($where)->count(); //计算记录数
            $limitRows = 10; // 设置每页记录数
            $p = new \Think\AdminPage($count, $limitRows);
            $limit_value = $p->firstRow . "," . $p->listRows;
            $list = $list->order("id desc")->where($where)->limit($limit_value)->select();
            $page = $p->show();
            $this->assign('page',$page);
            $this->assign('list', $list);
        }else{
            $list = M("member");
            $count = $list->count(); //计算记录数
            $limitRows = 10; // 设置每页记录数
            $p = new \Think\AdminPage($count, $limitRows);
            $limit_value = $p->firstRow . "," . $p->listRows;
            $list = $list->order("id desc")->limit($limit_value)->select();
            $page = $p->show();
            $this->assign('page',$page);
            $this->assign('list', $list);
        }
        $this->display();
    }

    //批量删除
    public function mdel() {
        $id = $_REQUEST['id'];
//       dump($id);exit;
        if (!empty($id)) {
            $condition[id] =  array('in', $id);
            $model = M('member')->where($condition)->delete();
            if ($model) {
                $this->success('删除成功！', U('user/index'));
            } else {
                $this->error('删除失败！', U('user/index'));
            }
        } else {
            $this->error('非法操作');
        }
    }

    //批量审核
    public function check(){
        $id=$_REQUEST['id'];
//        dump($id);exit;
        if (!empty($id)) {
            //dump(explode(',', $id));exit;
            $data[status]=1;
            $where[id] =  array('in', $id);
            $model = M('member')->where($where)->data($data)->save();
            if ($model) {
                $this->success('审核成功！', U('user/index'));
            } else {
                $this->error('审核失败！', U('user/index'));
            }
        } else {
            $this->error('非法操作');
        }
    }

    public function update() {
        if ($_POST) {
            $data = $_POST[data];
            $data[id] = $_GET[id];
            $upload = new \Think\Upload();// 实例化上传类
                $upload->maxSize   =     3145728 ;// 设置附件上传大小
                $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
                $upload->rootPath  =     './Upload/'; // 设置附件上传根目录
                $upload->savePath  =     ''; // 设置附件上传（子）目录
                // 上传文件
                $info   =   $upload->uploadOne($_FILES['imgpath']);


                    if($info) {
                        $data["imgpath"]=$info['savepath'].$info['savename'];
                    }
            //dump($data);exit;
            $data[password] = md5($data[password]);
            $result = M("member")->save($data);
            if ($result!==FALSE) {
                $this->success('修改成功！',U('User/index'));
//                $this->redirect("User/index");
            } else {
                $this->error('修改失败！');
//                $this->redirect("User/index");
            }
        }
    }

    public function gupdate() {
        if ($_POST) {
            $data = $_POST[data];
            $data[id] = $_GET[id];
            //dump($data);exit;
            $list = M("group")->save($data);
            if ($list) {
                $this->success('修改成功！',U('User/group'));
//                $this->redirect("User/group");
            } else {
                $this->error($list->getError());
//                $this->redirect("User/group");
            }
        }
    }

    public function add() {
        $group=M('group');
        $group=$group->select();
        $this->assign('group',$group);
        if ($_POST) {
            $list=D('Member');
            $data = $_POST[data];
            $upload = new \Think\Upload();// 实例化上传类
            $upload->maxSize   =     3145728 ;// 设置附件上传大小
            $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
            $upload->rootPath  =     './Upload/'; // 设置附件上传根目录
            $upload->savePath  =     ''; // 设置附件上传（子）目录
            //dump($_FILES['imgpath']);exit;
            // 上传文件
            $info   =   $upload->uploadOne($_FILES['imgpath']);
            if(!$info) {// 上传错误提示错误信息
                $this->error($upload->getError());
            }else{// 上传成功
                $data["imgpath"]=$info['savepath'].$info['savename'];
            }

            $data[reg_time] = date('Y-m-d H:i:s', time());
            $data[password] = md5($data[password]);
            if($list->add($data)){
                $this->success('添加成功！',U('User/index'));
            }else{
                $this->error('添加失败！',U('User/add'));
            }
        }
        $this->display();
    }

    public function gadd(){
        if($_POST){
            $list=D('Group');
            $data=$_POST[data];
            if($list->create($data)){
                if($list->add()){
                    $this->success('添加成功！',U('User/group'));
                }else{
                    $this->error('添加失败！',U('User/gadd'));
                }
            }else{
                $this->error($list->getError());
            }
        }
        $this->display();
    }

    public function edit() {

        $id[id] = $_GET['id'];
        $list = M('member')->where($id)->find();
        $this->assign('list', $list);
        $this->display();
    }

    public function gedit(){
        $id[id]=$_GET['id'];
        $list=M('group')->where($id)->find();
        //dump($list);exit;
        $this->assign('list', $list);
        $this->display();
    }

    public function manage(){
        $id=$_GET[id];
        $result=M('member')->where('id='.$id)->find();
        $this->assign('result',$result);
        if($_POST){
            $data=$_POST[data];
            $data[m_id]=$_GET[id];
            $data[updatetime]=date('Y-m-d H:i:s', time());
            $data[manager]=$_SESSION[username];
            $t[id]=$id;
            $t[balance]=$result[balance]+$data[m_change];
            $result=M('member')->save($t);
            $list=M('mlog')->add($data);
            if($list || $result){
                $this->success('添加成功！',U('User/index'));
            }else{
                $this->error('添加失败！');
            }
        }
        $this->display();
    }

    public function log(){
        $list = M("mlog");
        $id=$_GET[id];
        $count = $list->count(); //计算记录数
        $limitRows = 10; // 设置每页记录数
        $p = new \Think\AdminPage($count, $limitRows);
        $limit_value = $p->firstRow . "," . $p->listRows;
        $list = $list->order("id desc")->limit($limit_value)->where('m_id='.$id)->select();
//        dump($list);
        $page = $p->show();
        $this->assign('page',$page);
        $this->assign('list', $list);
        $this->display();
    }

    //删除新闻
    public function delete() {
        $id = $_GET[id];
        $list = M('member')->delete($id);
        if ($list) {
            $this->success('删除成功！',U('User/index'));
//            $this->redirect("User/index");
        } else {
            $this->error($list->getError());
//            $this->redirect("User/index");
        }
    }

    //删除新闻
    public function gdel() {
        $id = $_GET[id];
        $list = M('group')->delete($id);
        if ($list) {
            $this->success('删除成功！',U('User/group'));
//            $this->redirect("User/index");
        } else {
            $this->error($list->getError());
//            $this->redirect("User/index");
        }
    }

    //批量删除
    public function del() {
        $id = $_REQUEST['id'];
        //dump($id);exit;
        if (!empty($id)) {
            $model = M('member')->where(array('id' => array('in', $id)))->delete();
            if ($model) {
                $this->success('删除成功！',U('User/index'));
//                $this->redirect("User/index");
            } else {
                $this->error($model->getError());
//                $this->redirect("User/index");
            }
        } else {
            $this->error('非法操作');
        }
    }

    public function group() {
        $list = M('group');
        $list = $list->select();
        $this->assign('list', $list);
        $this->display();
    }

    public function yezhu() {
        $res=M('group')->select();
        $this->assign('res',$res);
        if($_POST){
            $name=$_POST[name];
            $list = M("member");
            $where[username]=array('like','%'.$name.'%');
            $where[group_id]=2;
//            $r=M('Group')->where($where)->find();
            $count = $list->where($where)->count(); //计算记录数
            $limitRows = 10; // 设置每页记录数
            $p = new \Think\AdminPage($count, $limitRows);
            $limit_value = $p->firstRow . "," . $p->listRows;
            $list = $list->order("id desc")->where($where)->limit($limit_value)->select();
            $page = $p->show();
            $this->assign('page',$page);
            $this->assign('list', $list);
        }else{
            $list = M("member");
            $count = $list->where('group_id=2')->count(); //计算记录数
            $limitRows = 10; // 设置每页记录数
            $p = new \Think\AdminPage($count, $limitRows);
            $limit_value = $p->firstRow . "," . $p->listRows;
            $list = $list->order("id desc")->where('group_id=2')->limit($limit_value)->select();
            $page = $p->show();
            $this->assign('page',$page);
            $this->assign('list', $list);
        }
        $this->display();
    }

    public function yadd() {
        $group=M('group');
        $group=$group->select();
        $this->assign('group',$group);
        if ($_POST) {
            $list=D('Member');
            $data = $_POST[data];
            $upload = new \Think\Upload();// 实例化上传类
            $upload->maxSize   =     3145728 ;// 设置附件上传大小
            $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
            $upload->rootPath  =     './Upload/'; // 设置附件上传根目录
            $upload->savePath  =     ''; // 设置附件上传（子）目录
            //dump($_FILES['imgpath']);exit;
            // 上传文件
            $info   =   $upload->uploadOne($_FILES['imgpath']);
            if(!$info) {// 上传错误提示错误信息
                $this->error($upload->getError());
            }else{// 上传成功
                $data["imgpath"]=$info['savepath'].$info['savename'];
            }

            $data[reg_time] = date('Y-m-d H:i:s', time());
            $data[password] = md5($data[password]);
            if($list->add($data)){
                $this->success('添加成功！',U('User/yezhu'));
            }else{
                $this->error('添加失败！',U('User/yadd'));
            }
        }
        $this->display();
    }

    public function shejishi() {
        $res=M('group')->select();
        $this->assign('res',$res);
        if($_POST){
            $name=$_POST[name];
            $list = M("member");
            $where[username]=array('like','%'.$name.'%');
            $where[group_id]=3;
//            $r=M('Group')->where($where)->find();
            $count = $list->where($where)->count(); //计算记录数
            $limitRows = 10; // 设置每页记录数
            $p = new \Think\AdminPage($count, $limitRows);
            $limit_value = $p->firstRow . "," . $p->listRows;
            $list = $list->order("id desc")->where($where)->limit($limit_value)->select();
            $page = $p->show();
            $this->assign('page',$page);
            $this->assign('list', $list);
        }else{
            $list = M("member");
            $count = $list->where('group_id=3')->count(); //计算记录数
            $limitRows = 10; // 设置每页记录数
            $p = new \Think\AdminPage($count, $limitRows);
            $limit_value = $p->firstRow . "," . $p->listRows;
            $list = $list->order("id desc")->where('group_id=3')->limit($limit_value)->select();
            $page = $p->show();
            $this->assign('page',$page);
            $this->assign('list', $list);
        }
        $this->display();
    }

    public function sadd() {
        $group=M('group');
        $group=$group->select();
        $this->assign('group',$group);
        if ($_POST) {
            $list=D('Member');
            $data = $_POST[data];
            $upload = new \Think\Upload();// 实例化上传类
            $upload->maxSize   =     3145728 ;// 设置附件上传大小
            $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
            $upload->rootPath  =     './Upload/'; // 设置附件上传根目录
            $upload->savePath  =     ''; // 设置附件上传（子）目录
            //dump($_FILES['imgpath']);exit;
            // 上传文件
            $info   =   $upload->uploadOne($_FILES['imgpath']);
            if(!$info) {// 上传错误提示错误信息
                $this->error($upload->getError());
            }else{// 上传成功
                $data["imgpath"]=$info['savepath'].$info['savename'];
            }

            $data[reg_time] = date('Y-m-d H:i:s', time());
            $data[password] = md5($data[password]);
            //dump($data);exit;
            if($list->add($data)){
                $this->success('添加成功！',U('User/shejishi'));
            }else{
                $this->error('添加失败！',U('User/shejishi'));
            }
        }
        $this->display();
    }

    public function zhijianyuan() {
        $res=M('group')->select();
        $this->assign('res',$res);
        if($_POST){
            $name=$_POST[name];
            $list = M("member");
            $where[username]=array('like','%'.$name.'%');
            $where[group_id]=4;
//            $r=M('Group')->where($where)->find();
            $count = $list->where($where)->count(); //计算记录数
            $limitRows = 10; // 设置每页记录数
            $p = new \Think\AdminPage($count, $limitRows);
            $limit_value = $p->firstRow . "," . $p->listRows;
            $list = $list->order("id desc")->where($where)->limit($limit_value)->select();
            $page = $p->show();
            $this->assign('page',$page);
            $this->assign('list', $list);
        }else{
            $list = M("member");
            $count = $list->where('group_id=4')->count(); //计算记录数
            $limitRows = 10; // 设置每页记录数
            $p = new \Think\AdminPage($count, $limitRows);
            $limit_value = $p->firstRow . "," . $p->listRows;
            $list = $list->order("id desc")->where('group_id=4')->limit($limit_value)->select();
            $page = $p->show();
            $this->assign('page',$page);
            $this->assign('list', $list);
        }
        $this->display();
    }

    public function zadd() {
        $group=M('group');
        $group=$group->select();
        $this->assign('group',$group);
        if ($_POST) {
            $list=D('Member');
            $data = $_POST[data];
            $upload = new \Think\Upload();// 实例化上传类
            $upload->maxSize   =     3145728 ;// 设置附件上传大小
            $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
            $upload->rootPath  =     './Upload/'; // 设置附件上传根目录
            $upload->savePath  =     ''; // 设置附件上传（子）目录
            //dump($_FILES['imgpath']);exit;
            // 上传文件
            $info   =   $upload->uploadOne($_FILES['imgpath']);
            if(!$info) {// 上传错误提示错误信息
                $this->error($upload->getError());
            }else{// 上传成功
                $data["imgpath"]=$info['savepath'].$info['savename'];
            }

            $data[reg_time] = date('Y-m-d H:i:s', time());
            $data[password] = md5($data[password]);
            if($list->add($data)){
                $this->success('添加成功！',U('User/zhijianyuan'));
            }else{
                $this->error('添加失败！',U('User/zhijianyuan'));
            }
        }
        $this->display();
    }

    public function gongren() {
        $res=M('group')->select();
        $this->assign('res',$res);
        if($_POST){
            $name=$_POST[name];
            $list = M("member");
            $where[username]=array('like','%'.$name.'%');
            $where[group_id]=5;
//            $r=M('Group')->where($where)->find();
            $count = $list->where($where)->count(); //计算记录数
            $limitRows = 10; // 设置每页记录数
            $p = new \Think\AdminPage($count, $limitRows);
            $limit_value = $p->firstRow . "," . $p->listRows;
            $list = $list->order("id desc")->where($where)->limit($limit_value)->select();
            $page = $p->show();
            $this->assign('page',$page);
            $this->assign('list', $list);
        }else{
            $list = M("member");
            $count = $list->where('group_id=5')->count(); //计算记录数
            $limitRows = 10; // 设置每页记录数
            $p = new \Think\AdminPage($count, $limitRows);
            $limit_value = $p->firstRow . "," . $p->listRows;
            $list = $list->order("id desc")->where('group_id=5')->limit($limit_value)->select();
            $page = $p->show();
            $this->assign('page',$page);
            $this->assign('list', $list);
        }
        $this->display();
    }

    public function gradd() {
        $group=M('group');
        $group=$group->select();
        $this->assign('group',$group);
        if ($_POST) {
            $list=D('Member');
            $data = $_POST[data];
            $upload = new \Think\Upload();// 实例化上传类
            $upload->maxSize   =     3145728 ;// 设置附件上传大小
            $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
            $upload->rootPath  =     './Upload/'; // 设置附件上传根目录
            $upload->savePath  =     ''; // 设置附件上传（子）目录
            //dump($_FILES['imgpath']);exit;
            // 上传文件
            $info   =   $upload->uploadOne($_FILES['imgpath']);
            if(!$info) {// 上传错误提示错误信息
                $this->error($upload->getError());
            }else{// 上传成功
                $data["imgpath"]=$info['savepath'].$info['savename'];
            }

            $data[reg_time] = date('Y-m-d H:i:s', time());
            $data[password] = md5($data[password]);
            if($list->add($data)){
                $this->success('添加成功！',U('User/gongren'));
            }else{
                $this->error('添加失败！',U('User/gongren'));
            }
        }
        $this->display();
    }

    public function power(){

        $this->display();
    }
    public function point(){

         $val=$_POST['val'];
       if(!empty($_POST['id'])){
           $data[id]=$_POST['id'];
           $data[m_power]=$val;
           $result = M("member")->save($data);

       }
    }
}