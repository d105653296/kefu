<?php
namespace Admin\Controller;

class CategoryController extends AdminController {


    public function index() {
        $tree = D('Category')->where('pid=0')->order('sort asc')->select();
        $this->assign('tree', $tree);
        $this->display();
    }

    function tree($pid) {
        $Cate = M('Category');
        $Cate = $Cate->where('pid=' . $pid)->order('sort asc')->select();
        if (!empty($Cate)) {
            $this->assign('Cate', $Cate);
            $this->display('tree');
        }
    }

    /* 编辑分类 */
    public function edit() {
        $id[id] = $_GET[id];
        $list = M('category');
        $list = $list->where($id)->find();
        $model = D('model')->select();
        $this->assign('model', $model);
        $this->assign('list', $list);
        $this->display();
        if ($_POST) {
            $data = $_POST[data];
            //dump($data);exit;
            $data[content] = $_POST['content'];
            $result = M("category")->save($data);
            if ($result) {
                $this->success('修改成功！',U('category/index'));
//                $this->redirect("category/index");
            }else{
                $this->error('修改失败！');
            }
        }
    }

    /* 新增分类 */

    public function add() {
        $id[id] = $_GET['id'];
        $arrid = D('Category')->where($id)->find();
        $this->assign('arrid', $arrid);
        $model = D('model')->select();
        $this->assign('model', $model);
        $this->display();
    }

    public function update() {
        $data = $_POST[data];
        
        $list = D('category');   
        if($list->create($data)){
           
            if (!empty($data['pid'])) {
            $data[arrid] = $data['arrid'] . ',' . $data['pid'];

            $data[content] = $_POST['content'];
        //   dump($data);exit;
            
                $result = $list->add($data);
                if ($result) {
                //    $this->success('添加成功！',U('category/index'));
                        $this->redirect("Category/index");
                } else {
                    $this->error('添加失败！');
                }
            
            } else {
                $data = $_POST[data];
                $data[pid] = '0';
                $data[arrid] = '0';
                $data[content] = $_POST['content'];
                //dump($data);exit;
                $list = D('category');
                if($list->create($data)){
                    $result = $list->add($data);
                    if ($result) {
                    //    $this->success('添加成功！',U('category/index'));
                            $this->redirect("Category/index");
                    } else {
                        $this->error('添加失败！');
                    }
                }
            }
        }else{
                $this->error($list->getError());
            } 
        $this->display('index');
    }

    //删除
    public function delete() {
        $id = $_GET[id];
        $list = M('category');

        $result = $list->where('id=' . $id)->find();
        $resall=$list->where('pid='.$result[id])->select();
        if($resall){
            $this->error('请先删除下级分类');
//            echo "<script>alert('请先删除下级分类');history.go(-1);</script>";
        }else{
            $a=$list->where('id='.$id)->delete();
            if($a){
           //     $this->success('删除成功！',U('category/index'));
             $this->redirect("Category/index");
            }else{
                $this->error('删除失败！');
            }
        }
      
    }

    //批量删除
    public function del() {
        $id = $_REQUEST['id'];
        //dump($id);exit;
        if (!empty($id)) {
            $model = M('category')->where(array('id' => array('in', $id)))->delete();
            if ($model) {
     //           $this->success('删除成功！',U('category/index'));
               $this->redirect("Category/index");
            } else {
                $this->error('删除失败！');
//                $this->redirect("Category/index");
            }
        } else {
            $this->error('非法操作');
        }
    }

}
