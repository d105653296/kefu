<?php

namespace Admin\Controller;

use Admin\Model\AuthGroupModel;
use Think\Page;

/**
 * 后台内容控制器
 */
class ArticleController extends AdminController {

    protected function _initialize() {
        header("Content-Type:text/html; charset=utf-8");
        $user = $_SESSION['username'];
        if (empty($user)) {
            $this->redirect('public/login');
        }
    }

    public function index() {
        if ($_POST) {
            $name = $_POST[name];
            if (!empty($name)) {
                $list = M('Article');
                $count = $list->where('name=' . $name)->count();
                $limitRows = 10;
                $p = new \Think\Page($count, $limitRows);
                $limit_value = $p->firstRow . "," . $p->listRows;
                $where[name] = array('like', '%' . $name . '%');
                $list = M('Article')->order("id desc")->where($where)->limit($limit_value)->select();
                $page = $p->show();
                $this->assign('list', $list);
                $this->assign(page, $page);
            } else {
                $list = M("Article");
                $count = $list->count(); //计算记录数
                $limitRows = 10; // 设置每页记录数
                $p = new \Think\Page($count, $limitRows);
                $limit_value = $p->firstRow . "," . $p->listRows;
                $list = $list->order("id desc")->limit($limit_value)->select();
                $page = $p->show();
                $this->assign('list', $list);
                $this->assign(page, $page);
            }
        } else {
            $list = M("Article");
            $count = $list->where('status=1')->count(); //计算记录数
            $limitRows = 10; // 设置每页记录数
            $p = new \Think\Page($count, $limitRows);
            $limit_value = $p->firstRow . "," . $p->listRows;
            $list = $list->order("id desc")->where('status=1')->limit($limit_value)->select();
            $page = $p->show();
            $this->assign('list', $list);
            $this->assign(page, $page);
        }
        $this->display();
    }

    public function unshenhe() {
        $count = M('article')->where('status=0')->count(); //计算记录数
        $limitRows = 10; // 设置每页记录数
        $p = new \Think\AdminPage($count, $limitRows);
        $limit_value = $p->firstRow . "," . $p->listRows;
        $list = M('article')->limit($limit_value)->where('status=0')->select();
        $page = $p->show();
        $this->assign('page', $page);
        $this->assign('list', $list);
        $this->display('Article/index');
    }

    public function zhiding() {
        $count = M('article')->where('is_top=1')->count(); //计算记录数
        $limitRows = 10; // 设置每页记录数
        $p = new \Think\AdminPage($count, $limitRows);
        $limit_value = $p->firstRow . "," . $p->listRows;
        $list = M('article')->limit($limit_value)->where('is_top=1')->select();
        $page = $p->show();
        $this->assign('page', $page);
        $this->assign('list', $list);
        $this->display('Article/index');
    }

    public function toutiao() {
        $count = M('article')->where('is_headlines=1')->count(); //计算记录数
        $limitRows = 10; // 设置每页记录数
        $p = new \Think\AdminPage($count, $limitRows);
        $limit_value = $p->firstRow . "," . $p->listRows;
        $list = M('article')->limit($limit_value)->where('is_headlines=1')->select();
        $page = $p->show();
        $this->assign('page', $page);
        $this->assign('list', $list);
        $this->display('Article/index');
    }

    public function tuijian() {
        $count = M('article')->where('is_recommend=1')->count(); //计算记录数
        $limitRows = 10; // 设置每页记录数
        $p = new \Think\AdminPage($count, $limitRows);
        $limit_value = $p->firstRow . "," . $p->listRows;
        $list = M('article')->limit($limit_value)->where('is_recommend=1')->select();
        $page = $p->show();
        $this->assign('page', $page);
        $this->assign('list', $list);
        $this->display('Article/index');
    }

    public function shouji() {
        $count = M('article')->where('is_phone=1')->count(); //计算记录数
        $limitRows = 10; // 设置每页记录数
        $p = new \Think\AdminPage($count, $limitRows);
        $limit_value = $p->firstRow . "," . $p->listRows;
        $list = M('article')->limit($limit_value)->where('is_phone=1')->select();
        $page = $p->show();
        $this->assign('page', $page);
        $this->assign('list', $list);
        $this->display('Article/index');
    }

    public function weixin() {
        $count = M('article')->where('is_wechat=1')->count(); //计算记录数
        $limitRows = 10; // 设置每页记录数
        $p = new \Think\AdminPage($count, $limitRows);
        $limit_value = $p->firstRow . "," . $p->listRows;
        $list = M('article')->limit($limit_value)->where('is_wechat=1')->select();
        $page = $p->show();
        $this->assign('page', $page);
        $this->assign('list', $list);
        $this->display('Article/index');
    }

    public function add() {
        $con['username'] = $_SESSION[username];
        $list = M('member')->where($con)->find();
        $where['pid'] = 0;
        $where['modelid'] = 2;

        $tree = D('Category')->where($where)->select();
//       dump($tree);
        $this->assign('tree', $tree);
        if ($_POST) {
            $data = $_POST[data];
            $list = D('Article');
            // var_dump($_FILES);exit;
            if (!empty($_FILES['imgpath']['name'])) {
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
            $data[status] = 1;
            $data[content] = $_POST['content'];
            $data[createtime] = date('Y-m-d H:i:s', time());
            $data[author] = $_SESSION[username];

            if ($list->add($data)) {
                $this->success('添加成功！', U('Article/add'));
            } else {
                //var_dump($data);exit;
                $this->error($list->getLastSql());
            }
        }
        $time = date(DATE_RFC822);
        $this->assign('time', $time);
        $this->display();
    }

    //删除新闻
    public function delete() {
        $id = $_GET[id];
        $list = M('article')->delete($id);
        if ($list) {
            $this->success('删除成功！', U('Article/index'));
        } else {
            $this->error('删除失败！', U('Article/index'));
        }
    }

    //批量删除
    public function del() {
        $id = $_REQUEST['id'];
//        dump($id);exit;
        if (!empty($id)) {
            $condition[id] = array('in', $id);
            $model = M('article')->where($condition)->delete();
            if ($model) {
                $this->success('删除成功！', U('Article/index'));
            } else {
                $this->error('删除失败！', U('Article/index'));
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
        $list = M('article')->where($id)->find();
        $tree = D('Category')->where('pid=0 and modelid=2')->select();

        $this->assign('tree', $tree);
        $this->assign('list', $list);
        $this->display();
    }

    /**
     * 更新一条数据
     * @author huajie <banhuajie@163.com>
     */
    public function update() {

        $data = $_POST[data];
        $data[id] = $_GET['id'];
        $data[content] = $_POST[content];
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
//        dump($data);exit;
        $res = M('article')->save($data);
//        dump($data);exit;
        if ($res !== FALSE) {
            $this->success('修改成功！', U('Article/index'));
        } else {
            $this->error('修改失败！');
        }
    }

    public function so() {
        if ($_POST) {
            $name = $_POST[name];
            $list = M('Article')->where('name=' . $name)->select();
        }
    }

    //批量审核
    public function check() {
        $id = $_REQUEST['id'];
        if (!empty($id)) {
            $data[status] = 1;
            $where[id] = array('in', $id);
            $model = M('Article')->where($where)->data($data)->save();
            if ($model != FALSE) {
                $this->success('审核成功！', U('Article/index'));
            } else {
                $this->error('审核失败或已审核！', U('Article/index'));
            }
        } else {
            $this->error('非法操作');
        }
    }

    public function is_top() {
        $id = $_REQUEST['id'];
        if (!empty($id)) {
            //dump(explode(',', $id));exit;
            $data[is_top] = 1;
            $where[id] = array('in', $id);

            $model = M('Article')->where($where)->data($data)->save();
            if ($model) {
                $this->success('置顶成功！', U('Article/index'));
            } else {
                $this->error('置顶失败或已置顶！', U('Article/index'));
            }
        } else {
            $this->error('非法操作');
        }
    }

    public function headlines() {
        $id = $_REQUEST['id'];
        if (!empty($id)) {
            //dump(explode(',', $id));exit;
            $data[is_headlines] = 1;
            $where[id] = array('in', $id);
            $model = M('Article')->where($where)->data($data)->save();
            if ($model) {
                $this->success('已设置为头条！', U('Article/index'));
            } else {
                $this->error('未设置为头条或已设置为头条！', U('Article/index'));
            }
        } else {
            $this->error('非法操作');
        }
    }

    public function recommend() {
        $id = $_REQUEST['id'];
        if (!empty($id)) {
            //dump(explode(',', $id));exit;
            $data[is_recommend] = 1;
            $where[id] = array('in', $id);
            $model = M('Article')->where($where)->data($data)->save();
            if ($model) {
                $this->success('推荐成功！', U('Article/index'));
            } else {
                $this->error('推荐失败或已推荐成功！', U('Article/index'));
            }
        } else {
            $this->error('非法操作');
        }
    }

    public function phone() {
        $id = $_REQUEST['id'];
        if (!empty($id)) {
            //dump(explode(',', $id));exit;
            $data[is_phone] = 1;
            $where[id] = array('in', $id);
            $model = M('Article')->where($where)->data($data)->save();
            if ($model) {
                $this->success('成功推送到手机！', U('Article/index'));
            } else {
                $this->error('未推送到手机或已推送到手机！', U('Article/index'));
            }
        } else {
            $this->error('非法操作');
        }
    }

    public function wechat() {
        $id = $_REQUEST['id'];
        if (!empty($id)) {
            //dump(explode(',', $id));exit;
            $data[is_wechat] = 1;
            $where[id] = array('in', $id);
            $model = M('Article')->where($where)->data($data)->save();
            if ($model) {
                $this->success('成功推送到微信！', U('Article/index'));
            } else {
                $this->error('未推送到微信或已推送到微信！', U('Article/index'));
            }
        } else {
            $this->error('非法操作');
        }
    }

    public function uncheck() {
        $id = $_REQUEST['id'];
        if (!empty($id)) {
            $data[status] = 0;
            $where[id] = array('in', $id);
            $model = M('Article')->where($where)->data($data)->save();
            if ($model != FALSE) {
                $this->success('取消审核成功！', U('Article/index'));
            } else {
                $this->error('取消审核失败或已取消审核！', U('Article/index'));
            }
        } else {
            $this->error('非法操作');
        }
    }

    public function unis_top() {
        $id = $_REQUEST['id'];
        if (!empty($id)) {
            //dump(explode(',', $id));exit;
            $data[is_top] = 0;
            $where[id] = array('in', $id);

            $model = M('Article')->where($where)->data($data)->save();
            if ($model) {
                $this->success('取消置顶成功！', U('Article/index'));
            } else {
                $this->error('取消置顶失败或已取消置顶！', U('Article/index'));
            }
        } else {
            $this->error('非法操作');
        }
    }

    public function unheadlines() {
        $id = $_REQUEST['id'];
        if (!empty($id)) {
            //dump(explode(',', $id));exit;
            $data[is_headlines] = 0;
            $where[id] = array('in', $id);
            $model = M('Article')->where($where)->data($data)->save();
            if ($model) {
                $this->success('取消头条成功！', U('Article/index'));
            } else {
                $this->error('取消头条失败或已取消头条！', U('Article/index'));
            }
        } else {
            $this->error('非法操作');
        }
    }

    public function unrecommend() {
        $id = $_REQUEST['id'];
        if (!empty($id)) {
            //dump(explode(',', $id));exit;
            $data[is_recommend] = 0;
            $where[id] = array('in', $id);
            $model = M('Article')->where($where)->data($data)->save();
            if ($model) {
                $this->success('取消推荐成功！', U('Article/index'));
            } else {
                $this->error('取消推荐失败或已取消推荐！', U('Article/index'));
            }
        } else {
            $this->error('非法操作');
        }
    }

    public function unphone() {
        $id = $_REQUEST['id'];
        if (!empty($id)) {
            //dump(explode(',', $id));exit;
            $data[is_phone] = 0;
            $where[id] = array('in', $id);
            $model = M('Article')->where($where)->data($data)->save();
            if ($model) {
                $this->success('取消推送到手机成功！', U('Article/index'));
            } else {
                $this->error('取消推送到手机失败或已取消推送到手机！', U('Article/index'));
            }
        } else {
            $this->error('非法操作');
        }
    }

    public function unwechat() {
        $id = $_REQUEST['id'];
        if (!empty($id)) {
            //dump(explode(',', $id));exit;
            $data[is_wechat] = 0;
            $where[id] = array('in', $id);
            $model = M('Article')->where($where)->data($data)->save();
            if ($model) {
                $this->success('取消推送到微信成功！', U('Article/index'));
            } else {
                $this->error('取消推送到微信失败或已取消推送到微信！', U('Article/index'));
            }
        } else {
            $this->error('非法操作');
        }
    }

}
