<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>注册/登陆</title>
    </head>
    <body>
        <form action="<?php echo U('index/login');?>" method="post">
            <input type="text" style=" width:188px; height:35px;border:0; margin-top:  13px;color:#7d7d7d;padding-left:8px;" name="data[username]" value="请输入用户名" onfocus="if (this.value == '请输入用户名')this.value = ''" onblur="if (this.value == '')this.value = '请输入用户名'" /><br />
            <input type="text" style=" width:188px; height:35px;line-height:39px;border:0;color:#7d7d7d;padding-left: 8px;" name="password" value="请输入密码" onfocus=" if (this.type == 'text') {this.type = 'password'; this.value = '' }" onblur=" if (this.type == 'password' && this.value == '') { this.type = 'text';this.value = '请输入密码' }" /><br />
            <input id="bk_hower" type="submit" name="" value="登录" /> <a href="<?php echo U('index/register');?>" id="bk_hower">注册</a>
        </form>
    </body>
</html>