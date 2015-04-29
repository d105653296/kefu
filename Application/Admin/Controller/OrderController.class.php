<?php

namespace Admin\Controller;
use Admin\Model\AuthGroupModel;
use Think\Page;

/**
 * 后台内容控制器

 */
class OrderController extends AdminController {


    public function index() {
        if($_POST){
            $list = M("order");
            $name=$_POST[name];
            $where[subject]=array('like','%'.$name.'%');
            $count = $list->where($where)->count(); //计算记录数
            $limitRows = 10; // 设置每页记录数
            $p = new \Think\AdminPage($count, $limitRows);
            $limit_value = $p->firstRow . "," . $p->listRows;
            $list = $list->order("id desc")->where($where)->limit($limit_value)->select();
            $page = $p->show();
            $this->assign('list', $list);
            $this->assign(page, $page);
        }else{
            $list = M("order");
            $count = $list->count(); //计算记录数
            $limitRows = 10; // 设置每页记录数
            $p = new \Think\AdminPage($count, $limitRows);
            $limit_value = $p->firstRow . "," . $p->listRows;
            $list = $list->order("id desc")->limit($limit_value)->select();
            $page = $p->show();
            $this->assign('list', $list);
            $this->assign(page, $page);
        }        
        $this->display();
    }

    public function add() {
        if ($_POST) {
            $list=D('Order');
            $data = $_POST[data];
            if($list->create($data)){
                if($list->add()){
                    $this->success('添加成功！',U('Order/index'));
                }else{
                    $this->success('添加失败！',U('Order/add'));
                }
            }else{
                $this->error('添加失败！');
            }
        }
        $this->display();
    }

    //删除新闻
    public function delete() {
        $id = $_GET[id];
        $list = M('order')->delete($id);
        if ($list) {
            $this->success('删除成功！',U('Order/index'));
//            $this->redirect("Order/index");
        } else {
            $this->error('删除失败！');
//            $this->redirect("Order/index");
        }
    }

    //批量删除
    public function del() {
        $id = $_REQUEST['id'];
        //dump($id);exit;
        if (!empty($id)) {
            $model = M('order')->where(array('id' => array('in', $id)))->delete();
            if ($model) {
                $this->success('删除成功！',U('Order/index'));
//                $this->redirect("Order/index");
            } else {
                $this->error('删除失败！');
//                $this->redirect("Order/index");
            }
        } else {
            $this->error('非法操作');
        }
    }
    
    public function more(){
        $id=$_GET['id'];
        $list = M("order");
        $list=$list->where('id='.$id)->find();
        $this->assign('list',$list);
        $this->display();
    }
    
    public function edit(){
        $id=$_GET['id'];
        $list = M("order");
        $list=$list->where('id='.$id)->find();
        $this->assign('list',$list);
        
        if($_POST){
            $data=$_POST[data];
            
            $result = M("order")->save($data);
            if ($result!==FALSE) {
                $this->success('修改成功！',U('order/index'));
            } else {
                $this->error('修改失败！');

            }
        }
        $this->display();
    }

}
