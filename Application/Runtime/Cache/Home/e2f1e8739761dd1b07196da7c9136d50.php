<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>TODO supply a title</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <div class="reg">
            <form action="<?php echo U('index/register');?>" method="post">
                <ul>
                    <li>
                        <p>用户名</p>
                        <p><input type="text" name="username" /></p>
                    </li>
                    <li>
                        <p>密码</p>
                        <p><input type="password" name="password" id="" /></p>
                    </li>
                    <li>
                        <p>密码确认</p>
                        <p><input type="password" name="password2" id="" /></p>
                    </li>
                    <li>
                        <p>QQ</p>
                        <p><input type="text" name="qq" id="" /></p>
                    </li>
                    <li>
                        <p>E-mail</p>
                        <p><input type="text" name="email" id="" /></p>
                    </li>
                    <li>
                        <p>网站名称</p>
                        <p><input type="text" name="webname" id="" /></p>
                    </li>
                    <li>
                        <p>网站域名</p>
                        <p><input type="text" name="weburl" id="" /></p>
                    </li>
                    <li>
                        <p></p>
                        <p><input type="submit" id="" /></p>
                    </li>
                </ul>
            </form>
        </div>
    </body>
</html>