<?php
namespace Admin\Controller;

/**
 * 后台分类管理控制器
 */
class AreaController extends AdminController {

    /**
     * 分类管理列表
     */
    public function index() {
        
        $tree = M('Area')->where('pid=0')->order('sort desc')->select();

        $this->assign('tree', $tree);

        $this->display();
    }
    
        function tree($pid) {
        $Cate = M('Area');
        $Cate = $Cate->where('pid=' . $pid)->order('sort asc')->select();
        if (!empty($Cate)) {
            $this->assign('Cate', $Cate);
            $this->display('tree');
        }
    }
    
    /* 编辑分类 */

    public function edit() {
        $id[id] = $_GET[id];
        $list = M('Area');
        $list = $list->where($id)->find();
        $this->assign('list', $list);
        if ($_POST) {
            
            $data = $_POST[data];
            //dump($data);exit;
            $result = M("Area")->save($data);
            if ($result!==FALSE) {
                $this->success('修改成功！',U('Area/index'));
//                $this->redirect("Area/index");
            }else{
                $this->error($result->getError());
            }
        }
        $this->display();
    }

    /* 新增分类 */

    public function add() {
        $id[id] = $_GET['id'];
        $arrid = D('Area')->where($id)->find();
        $this->assign('arrid', $arrid);
        $this->display();
    }

    public function update() {
        $data = $_POST[data];
        if (!empty($data['pid'])) {
            $data[arrid] = $data['arrid'] . ',' . $data['pid'];
            //dump($data);exit;
            $list = M('Area')->add($data);
            if ($list) {
                $this->success('添加成功！',U('Area/index'));
//                $this->redirect("Area/index");
            } else {
                $this->error($list->getError());
//                $this->redirect("Area/index");
            }
        } else {
            $data = $_POST[data];
            $data[pid] = '0';
            $data[arrid] = '0';
            //dump($data);exit;
            $list = M('Area')->add($data);
            if ($list) {
                $this->success('添加成功！',U('Area/index'));
//                $this->redirect("Area/index");
            } else {
                $this->error($list->getError());
//                $this->redirect("Area/index");
            }
        }
        $this->display('index');
    }

    //删除
    public function delete() {
        $id = $_GET[id];
        $list = M('Area');

        $result = $list->where('id=' . $id)->find();
        $resall=$list->where('pid='.$result[id])->select();
        if($resall){
            $this->error('请先删除下级分类');
//            echo "<script>alert('请先删除下级分类');history.go(-1);</script>";
        }else{
            $a=$list->where('id='.$id)->delete();
            if($a){
                $this->success('删除成功！',U('Area/index'));
//                $this->redirect("Area/index");
            }else{
                $this->error($a->getError());
            }
        }
      
    }

    //批量删除
    public function del() {
        $id = $_REQUEST['id'];
        //dump($id);exit;
        if (!empty($id)) {
            $model = M('Area')->where(array('id' => array('in', $id)))->delete();
            if ($model) {
                $this->success('删除成功！',U('Area/index'));
//                $this->redirect("Area/index");
            } else {
                $this->error($model->getError());
//                $this->redirect("Area/index");
            }
        } else {
            $this->error('非法操作');
        }
    }
}
