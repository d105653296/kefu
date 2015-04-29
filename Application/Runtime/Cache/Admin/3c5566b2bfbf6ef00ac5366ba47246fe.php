<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>登录</title>
<link href="/kefu/Public/Admin/assets/css/css.css" rel="stylesheet" type="text/css" />
</head>
<!--[if IE 6 ]>   <body class="ie6">          <![endif]-->
<!--[if IE 7 ]>      <body class="ie7">          <![endif]-->
<!--[if IE 8 ]>      <body class="ie8">          <![endif]-->
<!--[if IE 9 ]>      <body class="ie9">          <![endif]-->
<!--[if (gt IE 9) ]> <body class="modern">       <![endif]-->
<!--[!(IE)]>   <body class="notIE modern"> <!--<![endif]-->
<div id="backgroundImage">
   <img src="/kefu/Public/Admin/assets/img/0.jpg" />
</div>
<div id="onbackgroundbody">
	<div class="main">
  <div class="bk">
      <form  action="<?php echo U('Public/login');?>" method="post">
		<div class="form">
    		<ul>
                    <li><span>用户名：</span><input type="text" name='data[username]' style="background-image: url(/kefu/Public/Admin/assets/img/4.jpg); width:217px; height:32px"/></li>
                    <li><span>密&nbsp;&nbsp;码：</span><input type="password" name="data[password]" style="background-image: url(/kefu/Public/Admin/assets/img/4.jpg); width:217px; height:32px"  /></li>
            </ul>
   	  </div>
   	<div class="box"><img src="/kefu/Public/Admin/assets/img/3.jpg" width="13" height="13" /><p>记住密码</p></div>
    	<div class="button">
        	<div class="button_l"> <input  type="reset" value="重置" class="button_r" /></div>
            <div class="button_r"> <input  type="submit" value="登录" class="button_r" /></div>
        </div>
      </form>
  </div>
</div>
</div>
</body>
</html>