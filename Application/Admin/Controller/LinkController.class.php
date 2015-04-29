<?php

namespace Admin\Controller;

use Think\Controller;

class LinkController extends AdminController {


    public function index() {
        $list = M("link");
        $count = $list->count(); //计算记录数
        $limitRows = 10; // 设置每页记录数
        $p = new \Think\AdminPage($count, $limitRows);
        $limit_value = $p->firstRow . "," . $p->listRows;
        $list = $list->order('id desc')->limit($limit_value)->select();
        $page = $p->show();
        $this->assign(page, $page);
        $this->assign('list', $list);
        $this->display();
    }

    public function edit() {
        $id[id] = $_GET['id'];
        $res = M('link');
        $list = $res->where($id)->find();
        $this->assign('list', $list);
        $this->display();
        if ($_POST) {
            $data = $_POST[data];
            if(!empty($_FILES['imgpath'])){
                $upload = new \Think\Upload(); // 实例化上传类
                $upload->maxSize = 3145728; // 设置附件上传大小
                $upload->exts = array('jpg', 'gif', 'png', 'jpeg'); // 设置附件上传类型
                $upload->rootPath = './Upload/'; // 设置附件上传根目录
                $upload->savePath = ''; // 设置附件上传（子）目录
                // 上传文件 
                $info = $upload->uploadOne($_FILES['imgpath']);
                if ($info) {
                    $data["imgpath"] = $info['savepath'] . $info['savename'];
                }
            }
            $res=M('link')->save($data); 
            if ($res!==FALSE) {
                $this->success('修改成功！',U('Link/index'));

            } else {
                $this->error('修改失败！');

            }
        }
    }

    public function add() {
        if ($_POST) {
            $data = $_POST[data];
         // dump($_FILES['imgpath']);exit;
         if(!empty($_FILES['imgpath']['name'])){
             $upload = new \Think\Upload(); // 实例化上传类
                $upload->maxSize = 3145728; // 设置附件上传大小
                $upload->exts = array('jpg', 'gif', 'png', 'jpeg'); // 设置附件上传类型
                $upload->rootPath = './Upload/'; // 设置附件上传根目录
                $upload->savePath = ''; // 设置附件上传（子）目录
                // 上传文件 
                $info = $upload->uploadOne($_FILES['imgpath']);
                
                if (!$info) {// 上传错误提示错误信息
                    $this->error($upload->getError());
                } else {// 上传成功
                    $data["imgpath"] = $info['savepath'] . $info['savename'];
                }  
          }
       //   dump($data);exit;
            $list = M('link')->add($data);
           // dump($list);exit;
            if ($list) {
                $this->success('添加成功！',U('Link/index'));
//                $this->redirect("Link/index");
            } else {
                $this->error($list->getError());
//                $this->redirect("Link/index");
            }
        }
        $this->display();
    }

    //批量删除
    public function del() {
        $id = $_REQUEST['id'];
        //dump($id);exit;
        if (!empty($id)) {
            $model = M('link')->where(array('id' => array('in', $id)))->delete();
            if ($model) {
                $this->success('删除成功！',U('Link/index'));

            } else {
                $this->error('删除失败！');

            }
        } else {
            $this->error('非法操作');
        }
    }

    //删除
    public function delete() {
        $id = $_GET[id];
        $list = M('link')->delete($id);
        if ($list) {
            $this->success('删除成功！',U('Link/index'));

        } else {
            $this->error('删除失败！');

        }
    }

}
