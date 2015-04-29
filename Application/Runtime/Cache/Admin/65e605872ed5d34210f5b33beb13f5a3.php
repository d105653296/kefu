<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
    <head>
        <title></title>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="/kefu/Public/Admin/assets/css/bootstrap.css" />
        <link rel="stylesheet" type="text/css" href="/kefu/Public/Admin/assets/css/bootstrap-responsive.css" />
        <link rel="stylesheet" type="text/css" href="/kefu/Public/Admin/assets/css/style.css" />
        <script type="text/javascript" src="/kefu/Public/Admin/assets/js/jquery.js"></script>
        <script type="text/javascript" src="/kefu/Public/Admin/assets/js/jquery.sorted.js"></script>
        <script type="text/javascript" src="/kefu/Public/Admin/assets/js/bootstrap.js"></script>
        <script type="text/javascript" src="/kefu/Public/Admin/assets/js/ckform.js"></script>
        <script type="text/javascript" src="/kefu/Public/Admin/assets/js/common.js"></script>
        <script type="text/javascript" src="/kefu/Public/Admin/assets/js/amstars.js"></script>
        <script type="text/javascript">
            $(function () {
                var all_checked = false;
                $(":checkbox").click(function () {
                    var table = $(this).parents("table");
                    if ($(this).attr("id") === "all") {
                        table.find(":checkbox").prop("checked", !all_checked);
                        all_checked = !all_checked;
                    }
                    else {
                        table.find(":checkbox[id!=all]").each(function (i) {
                            if (!$(this).is(":checked")) {
                                table.find("#all").prop("checked", false);
                                all_checked = false;
                                return false;
                            }
                            $("#all").prop("checked", true);
                            all_checked = true;
                        });
                    }
                });
            });
        </script>
        <script type="text/javascript">
            function check() {
                document.form.action = "<?php echo U('User/check');?>";
                document.form.submit();
            }
        </script>

        <script>
            function checkURL(id, val) {

                $.ajax({
                    type: "POST",
                    dataType: "text",
                    url: "<?=U('user/Gradeupdate')?>",
                   data: "id=" + id + "&val=" + val,
                    success: function (msg) {
                        alert("评分成功!");
                    },
                    error: function (XMLHttpRequest, textStatus, errorThrown) {
                        alert(XMLHttpRequest + textStatus + errorThrown);
                    }
                });

            }
        </script>

        <style type="text/css">
            body {
                padding-bottom: 40px;
            }
            .sidebar-nav {
                padding: 9px 0;
            }

            @media (max-width: 980px) {
                /* Enable use of floated navbar text */
                .navbar-text.pull-right {
                    float: none;
                    padding-left: 5px;
                    padding-right: 5px;
                }
            }


        </style>
    </head>
    <body>
        <form class="form-inline definewidth m20" action="<?php echo U('User/index');?>" method="post">
            角色：
            <input type="text" name="name" id="name" class="abc input-default" placeholder="" value="">&nbsp;&nbsp;
            <button type="submit" class="btn btn-primary">查询</button>&nbsp;&nbsp; <button type="button" class="btn btn-success" id="addnew">新增用户</button>
        </form>

        <form action="<?php echo U('User/mdel');?>" method="post" name="form">
            <table class="table table-bordered table-hover definewidth m10" >
                <thead>
                    <tr>
                        <th><input class="check-all" type="checkbox" id='all' name="all" /></th>
                        <th>编号</th>
                        <th>用户名称</th>
                        <th>角色</th>
                        <th>会员评分</th>
                        <th>账户余额</th>
                        <th>审核</th>
                        <th>管理操作</th>
                    </tr>
                </thead>
                <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                        <td><input type="checkbox" name="id[]" value="<?php echo ($vo["id"]); ?>" /></td>
                        <td><?php echo ($vo["id"]); ?></td>
                        <td><?php echo ($vo["username"]); ?></td>
                        <td><?php echo GetGroupName($vo[group_id],title);?></td>
                        <td>

                            <div class="amstars_show">

                                <a class="amstars" href="javascript:;"  title="当前得分<?php echo ($vo["grade"]); ?>">
                                    <font class="amstars_val" name="<?php echo ($vo["grade"]); ?>" id="<?php echo ($vo["id"]); ?>" style="width:<?php echo ($vo["grade"]); ?>px;"></font>
                                    <span></span>
                                </a>
                            </div></td>
                        <td><?php echo ($vo["balance"]); ?>元</td>
                        <td><?php if($vo[status]==1){echo '启用';}else{echo '禁用';} ?></td>
                    <td>
                        <a href="<?php echo U('User/power',array('pid'=>$vo[id]));?>">设置权限</a>
                        <a href="<?php echo U('User/edit',array('id'=>$vo[id]));?>">编辑</a>
                        <a href="<?php echo U('User/del',array('id'=>$vo[id]));?>">删除</a>
                        <a href="<?php echo U('User/manage',array('id'=>$vo[id]));?>">账户管理</a>
                        <a href="<?php echo U('User/log',array('id'=>$vo[id]));?>">账户日志</a>
                    </td>
                    </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                <tr><td colspan="8"><button type="submit" class="btn btn-primary">删除</button>&nbsp;&nbsp;<button type="button" class="btn btn-success" onclick="check()">审核</button></td></tr>
            </table>
        </form>
        <div class="inline pull-right page">
            <?php echo ($page); ?>
            <!--10122 条记录 1/507 页  <a href='#'>下一页</a>     <span class='current'>1</span><a href='#'>2</a><a href='/chinapost/index.php?m=Label&a=index&p=3'>3</a><a href='#'>4</a><a href='#'>5</a>  <a href='#' >下5页</a> <a href='#' >最后一页</a>    </div>-->
    </body>
</html>
<script>
    $(function () {

        $('#addnew').click(function () {

            window.location.href = "<?php echo U('User/add');?>";
        });


    });

    function del(id)
    {


        if (confirm("确定要删除吗？"))
        {

            var url = "index.html";

            window.location.href = url;

        }




    }
</script>