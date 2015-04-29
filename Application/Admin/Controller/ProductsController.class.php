<?php

namespace Admin\Controller;

use Admin\Model\AuthGroupModel;
use Think\Page;

/**
 * 后台内容控制器
 */
class ProductsController extends AdminController {

    public function _initialize(){
        //此处为解决Uploadify在火狐下出现http 302错误 重新设置SESSION
        $username= session_name();
        if (isset($_POST[$username])) {
            session_id($_POST[$username]);
            session_start();   
        }    

    }
    
    public function uploadify() {

        //设置上传目录        
        $path = "./upload/".date('Y-m-d', time())."/";        
        if (!empty($_FILES)) {
            //得到上传的临时文件流
            $tempFile = $_FILES['Filedata']['tmp_name'];
            //允许的文件后缀
            $fileTypes = array('jpg', 'jpeg', 'gif', 'png');
            //得到文件原名
            $fileName = iconv("UTF-8", "GB2312", $_FILES["Filedata"]["name"]);
            $fileParts = pathinfo($_FILES['Filedata']['name']);
           // dump($fileParts);exit;
            //接受动态传值
            $files = $_POST['typeCode'];

            //最后保存服务器地址
            if (!is_dir($path))
                //dump($path);exit;
                mkdir($path); 
            $fileName=time().rand().".".$fileParts[extension];
            if (move_uploaded_file($tempFile, $path . $fileName)) {
                  
                echo date('Y-m-d', time())."/" . $fileName;
            } else {
                echo $fileName . "上传失败！";
            }
        }
    }
    
   public function del() {
        if ($_POST['name'] != "") {
           // $info = explode(",", $_POST['name']);
            //count($info)
            $url = './upload/' . $_POST['name'];   
            
            if (unlink($url)) {
                $this->success("删除成功！");
            } else
                $this->error("删除失败！");
        } else
            $this->error("info is gap");
    }
    
    public function index() {
        if($_POST){
            $name=$_POST[name];
            $where[name]=array('like','%'.$name.'%');
            $list = M("products");
            $count = $list->where($where)->count(); //计算记录数
            $limitRows = 10; // 设置每页记录数
            $p = new \Think\AdminPage($count, $limitRows);
            $limit_value = $p->firstRow . "," . $p->listRows;            
            $list = $list->order("id desc")->where($where)->limit($limit_value)->select();
            $page = $p->show();
            //dump($page);exit;
            $this->assign('list', $list);
            $this->assign(page, $page);
        }else{
            $list = M("products");
            $count = $list->count(); //计算记录数
            $limitRows = 10; // 设置每页记录数
            $p = new \Think\AdminPage($count, $limitRows);
            $limit_value = $p->firstRow . "," . $p->listRows;
            //dump($limit_value);exit;
            $list = $list->order("id desc")->limit($limit_value)->select();
            $page = $p->show();
            //dump($page);exit;
            $this->assign('list', $list);
            $this->assign(page, $page);
        }        
        $this->display();
    }

    public function add() {
        $tree = D('Category')->where('pid=0 and modelid=5')->select();
        $this->assign('tree', $tree);
        $list = D('Area')->select();
        $this->assign('list', $list);
        if ($_POST) {
            $list=D('Products');
            $data = $_POST[data];
        
                if(!empty($_FILES['upfiles'])){
                    $upload = new \Think\Upload(); // 实例化上传类
                    $upload->maxSize = 314572800; // 设置附件上传大小
                    $upload->exts = array('zip','rar'); // 设置附件上传类型
                    $upload->rootPath = './Upload/'; // 设置附件上传根目录
                    $upload->savePath = ''; // 设置附件上传（子）目录
                    // 上传文件 
                     $info = $upload->uploadOne($_FILES['upfiles']);
                   //  dump($info);exit;
                    if (!$info) {// 上传错误提示错误信息
                        $this->error($upload->getError());
                    } else {// 上传成功
                        $data["upfiles"] = $info['savepath'] . $info['savename'];
                      // dump($data);exit;
                    }
                }            
                $data[imgpath]=substr($_POST['upimage'],0,-1);            
                $data[content] = $_POST['content'];
                $data[author]=$_SESSION['username'];           
                
                $res=M('member')->where('username='."'".$data[author]."'")->select();
              
                $data[member_id]=$res[0]['id'];
             
                $data[lastupdatetime] = date('Y-m-d H:i:s', time());
                
           
               
                if($list->add($data)){
                    $this->success('添加成功',U('Products/index'));
                }else{
                    $this->error('添加失败',U('Products/add'));
                }
            
        }
        $this->display();
    }

    //删除新闻
    public function delete() {
        $id = $_GET[id];
        $list = M('products')->delete($id);
        if ($list) {
            $this->success('删除成功！',U('Products/index'));
        } else {
            $this->error('删除失败！', U('Article/index'));
        }
    }

    //批量删除
    public function mdel() {
        $id = $_REQUEST['id'];
//       dump($id);exit;
        if (!empty($id)) {
            $condition[id] =  array('in', $id);
            $model = M('products')->where($condition)->delete();
            if ($model) {
                $this->success('删除成功！', U('Products/index'));
            } else {
                $this->error('删除失败！', U('Products/index'));
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
            $model = M('Products')->where($where)->data($data)->save();
            if ($model) {
                $this->success('审核成功！', U('Products/index'));
            } else {
                $this->error('审核失败！', U('Products/index'));
            }
        } else {
            $this->error('非法操作');
        }
    }

    /**
     * 文档编辑页面初始化
     * @author huajie <banhuajie@163.com>
     */
    public function edit() {
        $id[id] = $_GET['id'];
        $list = M('Products')->where($id)->find();
        if(!empty($list[imgpath])){
            $list1=  explode(',', $list[imgpath]);
        }
        $this->assign('list1', $list1);
        //dump($list);exit;
        $tree = D('Category')->where('pid=0 and modelid=5')->select();

        $this->assign('tree', $tree);
        $this->assign('list', $list);
        $this->display();
    }

    /**
     * 更新一条数据
   
     */
    public function update() {
        if($_POST){
            
            $data = $_POST[data];
            $data[content] = $_POST[content];
            $data[lastupdatetime] = date('Y-m-d H:i:s', time());
            $data[id] = $_GET['id'];
          
             if(!empty($_FILES['upfiles']['name'])){
                    $upload = new \Think\Upload(); // 实例化上传类
                    $upload->maxSize = 314572800; // 设置附件上传大小
                    $upload->exts = array('zip','rar'); // 设置附件上传类型
                    $upload->rootPath = './Upload/'; // 设置附件上传根目录
                    $upload->savePath = ''; // 设置附件上传（子）目录
                    // 上传文件 
                     $info = $upload->uploadOne($_FILES['upfiles']);
                   //  dump($info);exit;
                    if (!$info) {// 上传错误提示错误信息
                        $this->error($upload->getError());
                    } else {// 上传成功
                        $data["upfiles"] = $info['savepath'] . $info['savename'];
                      //  dump($data);exit;
                    }
                }  else {
                  //  var_dump($data['upfiles']);exit;
                    $data["upfiles"] = $data['upfiles'];
                } 

            //dump($_POST['imgpath']);exit;
           
                
                if(substr($_POST['upimage'],-1,1)==','){
                    $data['imgpath']=  substr($_POST['upimage'], 0,-1);
                }else{
                    $data['imgpath']=$_POST['upimage1'];
                }
            $res = M('Products')->save($data);
            //dump($data);exit;
            if ($res!==FALSE) {
                $this->success('修改成功！',U('Products/index'));

            } else {
                $this->error('修改失败');

            }
        }        
    }
}
