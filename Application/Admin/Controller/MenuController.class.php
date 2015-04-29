<?php
namespace Admin\Controller;

/**
 * 后台分类管理控制器
 * @author 麦当苗儿 <zuojiazi@vip.qq.com>
 */
class MenuController extends AdminController {

    /**
     * 分类管理列表
     */
    public function index() {
        $tree = M('Menu')->where('pid=0')->order('sort desc')->select();
        $this->assign('tree', $tree);
        $this->display();
    }
    
    function tree($pid) {
        $Cate = M('Menu');
        $Cate = $Cate->where('pid=' . $pid)->order('sort asc')->select();
        //dump($Cate);exit;
        if (!empty($Cate)) {
            $this->assign('Cate', $Cate);
            $this->display('tree');
        }
    }
    
    /* 编辑分类 */

    public function edit() {
        $id[id] = $_GET[id];
        $list = M('menu');
        $list = $list->where($id)->find();
        $this->assign('list', $list);
        //dump($id);exit;
        if ($_POST) {            
            $data = $_POST[data];
            //dump($data);exit;
            $result = M("menu")->save($data);
            if ($result!==FALSE) {
                $this->success('修改成功！',U('menu/index'));
//                $this->redirect("menu/index");
            }else{
                $this->error('修改失败！');
            }
        }
        $this->display();
    }

    /* 新增分类 */

    public function add() {
        $id[id] = $_GET['id'];
        $list = D('menu')->where($id)->find();
       // dump($arrid);exit;
        $this->assign('list', $list);
        $this->display();
    }

    public function update() {
        $data = $_POST[data];
        if (!empty($data['pid'])) {
            //$data[arrid] = $data['arrid'] . ',' . $data['pid'];
            //dump($data);exit;
            $list = M('menu')->add($data);
            if ($list) {
                $this->success('添加成功！',U('menu/index'));
//                $this->redirect("menu/index");
            } else {
                $this->error('添加失败');
//                $this->redirect("menu/index");
            }
        } else {
            $data = $_POST[data];
            $data[pid] = '0';
            //$data[arrid] = '0';
            //dump($data);exit;
            $list = M('menu')->add($data);
            if ($list) {
                $this->success('添加成功！',U('menu/index'));
//                $this->redirect("menu/index");
            } else {
                $this->error('添加失败');
//                $this->redirect("menu/index");
            }
        }
        $this->display('index');
    }

    //删除
    public function delete() {
        $id = $_GET[id];
        $list = M('menu');

        $result = $list->where('id=' . $id)->find();
        $resall=$list->where('pid='.$result[id])->select();
        if($resall){
            $this->error('请先删除下级分类');
//            echo "<script>alert('请先删除下级分类');history.go(-1);</script>";
        }else{
            $a=$list->where('id='.$id)->delete();
            if($a){
                $this->success('修改成功！',U('menu/index'));
                $this->redirect("menu/index");
            }
        }
      
    }

    //批量删除
    public function del() {
        $id = $_REQUEST['id'];
        //dump($id);exit;
        if (!empty($id)) {
            $model = M('menu')->where(array('id' => array('in', $id)))->delete();
            if ($model) {
                $this->success('删除成功！',U('menu/index'));
//                $this->redirect("menu/index");
            } else {
                $this->error('删除失败');
//                $this->redirect("menu/index");
            }
        } else {
            $this->error('非法操作');
        }
    }
}
