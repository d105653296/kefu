<?php
namespace Admin\Controller;
use Think\Controller;
class ConfigController extends AdminController {

    
    public function group(){
        $list=M('site')->where('id=1')->find();
        $this->assign('list',$list);
        $this->display();
    }
    
    public function update() {
        $result=D('Site');
        $data = $_POST[data];
       
            $data[id]=1;
            if($result->save($data)!==FALSE){
                $this->success('修改成功！',U('Config/group'));
            }else{
                $this->error('修改失败！');
            }
       
    }
}