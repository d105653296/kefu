<?php

namespace Admin\Controller;

use Admin\Model\AuthGroupModel;
use Think\Page;

/**
 * 后台内容控制器

 */
class BookController extends AdminController {

   
    public function index() {
        if($_POST){
            $list = M("book");
            $name=$_POST[name];
            $where[user]=array('like','%'.$name.'%');
            $count = $list->where($where)->count(); //计算记录数
            $limitRows = 10; // 设置每页记录数
            $p=new \Think\AdminPage($count, $limitRows);
            $limit_value = $p->firstRow . "," . $p->listRows;
            $list = $list->order("id desc")->where($where)->limit($limit_value)->select();
            $page = $p->show(); 
            $this->assign('list', $list);
            $this->assign(page,$page); 
        }else{
            $list = M("book");        
            $count = $list->count(); //计算记录数
            $limitRows = 10; // 设置每页记录数
            $p=new \Think\AdminPage($count, $limitRows);
            $limit_value = $p->firstRow . "," . $p->listRows;
            $list = $list->order("id desc")->limit($limit_value)->select();
            $page = $p->show(); 
            $this->assign('list', $list);
            $this->assign(page,$page); 
        }        
        $this->display();
    }

    //删除
    public function delete() {
        $id = $_GET[id];
        $list = M('book')->delete($id);
        if ($list) {
            $this->success('删除成功！',U('Book/index'));

        } else {
            $this->error($list->getLastSql());

        }
    }
	
	//批量删除
	public function del(){
		$id=$_REQUEST['id'];
		//dump($id);exit;
		if (!empty($id)) {
				//dump($id);exit;
				//dump(explode(',',$id));exit;
                //$condition = array(id => array('in', explode(',', $id)));
				//dump($condition);exit;
		$model=M('book')->where(array('id'=>array('in',$id)))->delete();
                if ($model) {
                    $this->success('删除成功！',U('Book/index'));

                } else {
                    $this->error($model->getLastSql());

                }
            } else {
                $this->error('非法操作');
            }
        }
		
    /**
     * 文档编辑页面初始化

     */
    public function edit() {
        $id[id] = $_GET['id'];
        $list = M('Book')->where($id)->find();
        $this->assign('list', $list);
        $this->display();
    }

    /**
     * 更新一条数据

     */
    public function update() {
        
        $data = $_POST[data];
        $data[uid] = $_GET['id'];
        $data[rename]=$_SESSION[username];
                
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
        $res=M('rebook')->add($data);
        if($res){
            $this->success('添加成功！',U('Book/index'));

        }else{
            $this->error($res->getLastSql());

        }
       
    }
    
    public function tender(){
        if($_POST){
            $list = M("tender");
            $name=$_POST[name];
            $where[name]=array('like','%'.$name.'%');
            $count = $list->where($where)->count(); //计算记录数
            $limitRows = 10; // 设置每页记录数
            $p = new \Think\AdminPage($count, $limitRows);
            $limit_value = $p->firstRow . "," . $p->listRows;
            $list=M('tender')->order("id desc")->where($where)->limit($limit_value)->select();
            $page = $p->show();
            $this->assign('list', $list);
            $this->assign(page, $page);
        }else{
            $list = M("tender");
            $count = $list->count(); //计算记录数
            $limitRows = 10; // 设置每页记录数
            $p = new \Think\AdminPage($count, $limitRows);
            $limit_value = $p->firstRow . "," . $p->listRows;
            $list=M('tender')->order("id desc")->limit($limit_value)->select();
            $page = $p->show();
            $this->assign('list', $list);
            $this->assign(page, $page);
        }        
        $this->display();
    }
    
    public function tdelete() {
        $id = $_GET[id];
        $list = M('tender')->delete($id);
        if ($list) {
            $this->success('删除成功！',U('Book/tender'));
//            $this->redirect("Book/tender");
        } else {
            $this->error($list->getLastSql());
//            $this->redirect("Book/tender");
        }
    }
    
    public function tedit(){
        $data[id]=$_GET[id];
        $result=M('tender')->where('id='.$data[id])->find();
        if($result[check]==0){
            $data[check]=1;
        }else{
            echo "<script>alert('不可重复操作！'); history.go(-1);</script>";
        }
        $list=M('tender')->save($data);
        if($list){
            $this->success('修改成功！',U('Book/index'));
//            $this->redirect("Book/tender");
        }  else {
            $this->error($list->getLastSql());
//            $this->redirect("Book/tender");
        }
    }
    
    public function nedit(){
        $data[id]=$_GET[id];
        $result=D('tender')->where('id='.$data[id])->find();
        if($result[check]==0){
            $data[check]=2;
        }else{
            echo "<script>alert('不可重复操作！'); history.go(-1);</script>";
        }
        $list=D('tender')->save($data);
        if($list){
            $this->success('修改成功！',U('Book/index'));

        }  else {
               $this->error($list->getLastSql());

        }
    }
    
    public function browse(){
        $id=$_GET[id];
        $result=M('book')->where('id='.$id)->find();
        $this->assign('result',$result);
        $list=M('rebook')->where('uid='.$id)->select();
        $this->assign('list',$list);
        $this->display();
    }
    
    public function delrebook(){
        $id=$_GET[id];
        $result=M('rebook')->delete($id);
        if($result){
            $this->success('删除成功！');
        }else{
            $this->error('删除失败！');
        }
    }
  
}
