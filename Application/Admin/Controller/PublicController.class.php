<?php

namespace Admin\Controller;

use Think\Controller;

/**
 * 后台首页控制器
 */
class PublicController extends Controller {

    /**
     * 后台用户登录
     */
    public function login() {

        if ($_POST) {
            $data = $_POST[data];
            //dump($data);exit;
            $where=array('username'=>$data[username],'status'=>1);
            $res = M('member')->where($where)->find();
            if(!$res){
                $this->error('用户名错误或用户名未通过审核！',U('Public/login'));
            }elseif (md5($data[password]) == $res[password]) {
                $i=$res[point];
                $ino[point]=$i+'1';
                $ino[id]=$res[id];
                $result=M('Member')->save($ino);
                $_SESSION[username]=$data[username];
                $this->success('登录成功！',U('index/index'));
            }else{
                $this->error('密码错误！',U('public/login'));
            }
        }
        $this->display();
    }
    /* 退出登录 */

    public function logout() {

         session('[destroy]'); // 销毁session
         $this->success('成功退出！',U('public/login'));

    }

//    public function upload(){
//        echo 111;
//      EXIT;
//        $files = array();
//$url = 'http://'.$_SERVER['SERVER_NAME'].':'.$_SERVER['SERVER_PORT'].rtrim(dirname($_SERVER['PHP_SELF']), '/\\')."/";
// //echo $url;
//// print_r($_SERVER);
//// print_r ($_FILES);
//
//$fileInput = 'Filedata';
//$dir = './upload/';
//$type = $_POST['type'];
//// @mkdir($dir);
//$isExceedSize = false;
///*-----------------*/
////以下三行代码用于删除文件，实际应用时请予以删除，get_file_count()和delDirAndFile（）函数都可以删掉
//$dirName =  'files';
//$size = get_file_count($dirName);
//if($size > 3) delDirAndFile($dirName);
///*-----------------*/
//$files_name_arr = array($fileInput);
//foreach($files_name_arr as $k=>$v){
//	$pic = $_FILES[$v];
//  $isExceedSize = $pic['size'] > 500000;
//  if(!$isExceedSize){
//    if(file_exists($dir.$pic['name'])){
//      @unlink($dir.$pic['name']);
//    }
//    // 解决中文文件名乱码问题
//    $pic['name'] = iconv('UTF-8', 'GBK', $pic['name']);
//    $result = move_uploaded_file($pic['tmp_name'], $dir.$pic['name']);
//    $files[$k] = $url.$dir.$pic['name'];
//	}
//}
//if(!$isExceedSize && $result){
//    $arr = array(
//        'status' => 1,
//        'type' => $type,
//        'name' => $_FILES[$fileInput]['name'],
//        'url' => $dir.$_FILES[$fileInput]['name']
//    );
//}else if($isExceedSize){
//    $arr = array(
//        'status' => 0,
//        'type' => $type,
//        'msg' => "文件大小超过500kb！"
//    );
//}else{
//    $arr = array(
//        'status' => 0,
//        'type' => $type,
//        'msg' => "未知错误！".$result
//    );
//}
//echo json_encode($arr);
//    }
}
