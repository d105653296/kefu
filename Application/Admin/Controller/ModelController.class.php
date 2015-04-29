<?php
namespace Admin\Controller;
use Think\Controller;

class ModelController extends AdminController {

    public function index(){
        $list=M('Model');
        $count = $list->count(); //计算记录数
        $limitRows = 10; // 设置每页记录数
        $p=new \Think\AdminPage($count, $limitRows);
        $limit_value = $p->firstRow . "," . $p->listRows;
        $list=M('Model')->order("id desc")->limit($limit_value)->select();
        $page = $p->show();
        $this->assign(page, $page);
        $this->assign('list',$list);
        $this->display();
    }
    
    public function add(){
        if ($_POST) {
            $data = $_POST[data];
            $list = M('model')->add($data);
            if ($list) {
                $this->success('添加成功！',U('Model/index'));
//                $this->redirect("Model/index");
            } else {
                $this->error('添加失败！');
//                $this->redirect("Model/index");
            }
        }
        $this->display();
    }
    
    public function edit(){
        $id=$_GET[id];
        $list=M('model')->where('id='.$id)->find();
        $this->assign('list',$list);
        $this->display();
    }
    
    public function update(){
        
        if($_POST){
            $data=$_POST[data];
            $result = M("model")->save($data);
            if ($result!==FALSE) {
                $this->success('修改成功！',U('Model/index'));
//                $this->redirect("Model/index");
            } else {
                $this->error('修改失败！');
//                $this->redirect("Model/index");
            }
        }
        $this->display();
    }
    
    //删除
    public function del() {
        $id = $_GET[id];
        $list = M('Model')->delete($id);
        if ($list) {
            $this->success('删除成功！',U('Model/index'));

        } else {
            $this->error('删除失败！');

        }
    }

}