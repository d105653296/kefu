<?php

//遍历文件夹
function traverse($path = '.') {
    $current_dir = opendir($path);    //opendir()返回一个目录句柄,失败返回false
    while (($file = readdir($current_dir)) !== false) {    //readdir()返回打开目录句柄中的一个条目
        $sub_dir = $path . DIRECTORY_SEPARATOR . $file;    //构建子目录路径
        if ($file == '.' || $file == '..') {
            continue;
        } else if (is_dir($sub_dir)) {    //如果是目录,进行递归
            echo 'Directory ' . $file . ':<br>';
            traverse($sub_dir);
        } else {    //如果是文件,直接输出
            echo $file . '|';
            $arr.=$file;
        }
    }
    return $arr;
}

function get_file_count($dir_name) {
    $files = 0;
    if ($handle = opendir($dir_name)) {
        while (false !== ($file = readdir($handle))) {
            $files++;
        }
        closedir($handle);
    }
    return $files;
}

//循环删除目录和文件
function delDirAndFile($dirName) {
    if ($handle = opendir($dirName)) {
        while (false !== ( $item = readdir($handle) )) {
            if ($item != "." && $item != "..") {
                unlink("$dirName/$item");
            }
        }
        closedir($handle);
    }
}

function uploadFile($file_label) {
    // global $url;
    $this_file = $_FILES[$file_label];
}
function arrypower($userid,$cateid){
    
    $list=M('member');
    $top=$list->where('id='.$userid)->find();
   if(empty($top[m_power])) {
       return TRUE;
   }else{
        $m_power=  explode(',', substr($top[m_power],0,-1));

        foreach($m_power as $k){

            if($cateid==$k){
                return TRUE;
            }
        }
   }
}
function Getpower($userid) {

    $list = M('category');
    $top = $list->where('pid=0')->select();
    $html = "";
    foreach ($top as $key) {
        $html.="{text : '$key[title]',id : '$key[id]'";
        if(arrypower($userid,$key[id])){
            $html.=",checked : true";
        }
        $first = $list->where('pid=' . $key[id])->select();
        //dump($first);exit;
        if (!empty($first)) {
            $html.=",children : [";
            foreach ($first as $k) {
                $html.="{text: '$k[title]', id: '$k[id]'},";
            }
            $html = substr($html, 0, -1);
            $html.="]";
        }
        $html.="},";
    }
    $html = substr($html, 0, -1);
    return $html;
}

function Getgroup() {
    $list = M('menu');
    $top = $list->where('pid=0 and hide=0')->select();
    $html = "";
    foreach ($top as $key) {
        $html.=" {
          id:'$key[id]', 
          homePage : 'code',
          menu:[";
        $groupname = $list->where('pid=' . $key[id] . ' and status=1')->select();
        $groupname1 = "";
        foreach ($groupname as $gname) {
            $groupname1[] = $gname[group];
        }
        $gname1 = array_unique($groupname1);

        foreach ($gname1 as $n1) {

            $html.="{
                      text:'$n1',
                      items:[";
            $group3->group = $n1;
            $group3->status = 1;
            $top3 = $list->where($group3)->order('sort asc')->select();

            foreach ($top3 as $gname3) {
                $ur = U($gname3['url']);
                $html.="{ id:'code',text:'$gname3[title]',href:'$ur',closeable : false },";
            }
            $html = substr($html, 0, -1) . "]},";
        }

        $html = substr($html, 0, -1) . "]
          },";
    }
    return $html;
}

function GetGroupName($id, $field) {
    $groupname = M('group')->where('id=' . $id)->find();
//dump($groupname);
    return $groupname[$field];
}

function Getname($pid, $modelid, $id) {
    $con['username'] = $_SESSION[username];
    $list = M('member')->where($con)->find();
    $Cate = M('Category');
    $where['pid'] = $pid;

//    return(dump($list));
    $Cate = $Cate->where($where)->select();
    $html = '';
    foreach ($Cate as $k => $v) {
        if ($v['pid'] == $pid) {
            $num = 0;
            $num = count(explode(',', $v['arrid']));

            $prefix = '';
            for ($i = 0; $i < $num; $i++) {
                $prefix.='&nbsp;&nbsp;&nbsp;';
            }
            if ($v['pid'] != 0) {
                $v['title'] = $prefix . '├─ ' . '&nbsp;&nbsp;&nbsp;&nbsp;' . $v['title'];
            }
            if ($id == $v['id']) {
           
                $n = 'selected="selected"';
            } else {
                $n = '';
            }
        if(arrypower($list[id],$v[id])){
           $html .= "<option value=" . $v['id'] . " " . $n . ">" . $v['title'] . "</option>";
        }
            
            $html .= Getname($v['id'], $v['modelid'], $id);
        }
    }
    return $html;
}

function GetCategoryName($CategoryId) {
    $Cate = M('Category')->where('id=' . $CategoryId)->find();
    return $Cate[title];
}

function Getmodelname($modelid) {
    $model = M('model')->where('id=' . $modelid)->find();
    return $model[title];
}

function GetAreaName($id) {
    $Cate = M('Area')->where('id=' . $id)->find();
    return $Cate[title];
}

function GetMenuName($pid) {
    $menu = M('menu')->where('pid=' . $pid)->select();

    return $menu[title];
}

function GetArea($pid) {
    $list = M('Area')->where('pid=' . $pid)->select();
//dump($pid);exit;
    $html = '';
    foreach ($list as $k => $v) {
        if ($v['pid'] == $pid) {
            $num = 0;
            $num = count(explode(',', $v['arrid']));

            $prefix = '';
            for ($i = 0; $i < $num; $i++) {
                $prefix.='&nbsp;&nbsp;&nbsp;';
            }
            if ($v['pid'] != 0) {
                $v['title'] = $prefix . '├─ ' . '&nbsp;&nbsp;&nbsp;&nbsp;' . $v['title'];
            }
            if ($id == $v['id']) {
                $n = 'selected';
            } else {
                $n = '';
            }

            $html .= "<option value=" . $v['id'] . " " . $n . ">" . $v['title'] . "</option>";
            $html .= Getname($v['id']);
        }
    }
    return $html;
}
