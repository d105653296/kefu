<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
    <head>
        <title>新闻管理</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="/kefu/Public/Admin/assets/css/bootstrap.css" />
        <link rel="stylesheet" type="text/css" href="/kefu/Public/Admin/assets/css/bootstrap-responsive.css" />
        <link rel="stylesheet" type="text/css" href="/kefu/Public/Admin/assets/css/style.css" />
        <script type="text/javascript" src="/kefu/Public/Admin/assets/js/jquery.js"></script>
        <script type="text/javascript" src="/kefu/Public/Admin/assets/js/jquery.sorted.js"></script>
        <script type="text/javascript" src="/kefu/Public/Admin/assets/js/bootstrap.js"></script>
        <script type="text/javascript" src="/kefu/Public/Admin/assets/js/ckform.js"></script>
        <script type="text/javascript" src="/kefu/Public/Admin/assets/js/common.js"></script>
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
                document.form.action = "<?php echo U('Article/check');?>";
                document.form.submit();
            }
            function is_top() {
                document.form.action = "<?php echo U('Article/is_top');?>";
                document.form.submit();
            }
            function headlines() {
                document.form.action = "<?php echo U('Article/headlines');?>";
                document.form.submit();
            }
            function recommend() {
                document.form.action = "<?php echo U('Article/recommend');?>";
                document.form.submit();
            }
            function phone() {
                document.form.action = "<?php echo U('Article/phone');?>";
                document.form.submit();
            }
            function wechat() {
                document.form.action = "<?php echo U('Article/wechat');?>";
                document.form.submit();
            }
            function uncheck() {
                document.form.action = "<?php echo U('Article/uncheck');?>";
                document.form.submit();
            }
            function unis_top() {
                document.form.action = "<?php echo U('Article/unis_top');?>";
                document.form.submit();
            }
            function unheadlines() {
                document.form.action = "<?php echo U('Article/unheadlines');?>";
                document.form.submit();
            }
            function unrecommend() {
                document.form.action = "<?php echo U('Article/unrecommend');?>";
                document.form.submit();
            }
            function unphone() {
                document.form.action = "<?php echo U('Article/unphone');?>";
                document.form.submit();
            }
            function unwechat() {
                document.form.action = "<?php echo U('Article/unwechat');?>";
                document.form.submit();
            }
            function unshenhe(){
                document.form.action="<?php echo U('Article/unshenhe');?>";
                document.form.submit();
            }
            function zhiding() {
                document.form.action = "<?php echo U('Article/zhiding');?>";
                document.form.submit();
            }
            function toutiao() {
                document.form.action = "<?php echo U('Article/toutiao');?>";
                document.form.submit();
            }
            function tuijian() {
                document.form.action = "<?php echo U('Article/tuijian');?>";
                document.form.submit();
            }
            function shouji() {
                document.form.action = "<?php echo U('Article/shouji');?>";
                document.form.submit();
            }
            function weixin() {
                document.form.action = "<?php echo U('Article/weixin');?>";
                document.form.submit();
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
        <form class="form-inline definewidth m20" action="<?php echo U('Article/index');?>" method="post">  
            新闻名称：
            <input type="text" name="name" id="name" class="abc input-default" placeholder="" value="">&nbsp;&nbsp;  
            <button type="submit" class="btn btn-primary">查询</button>&nbsp;&nbsp; <button type="button" class="btn btn-success" id="addnew">新增新闻</button>&nbsp;&nbsp; <button type="button" class="btn btn-primary" onclick="unshenhe()">未审核</button>&nbsp;&nbsp; <button type="button" class="btn btn-success" onclick="zhiding()" id="addnew">置顶</button>&nbsp;&nbsp; <button type="button" onclick="toutiao()" class="btn btn-primary">头条</button>&nbsp;&nbsp; <button type="button" class="btn btn-success" onclick="tuijian()" id="addnew">推荐</button>&nbsp;&nbsp; <button type="button" onclick="shouji()" class="btn btn-primary">手机</button>&nbsp;&nbsp; <button type="button" class="btn btn-success" onclick="weixin()" id="addnew">微信</button>
        </form>
        

        <form action="<?php echo U('Article/del');?>" method="post" name="form">
            <table class="table table-bordered table-hover definewidth m10" >
                <thead>
                    <tr>
                        <th><input class="check-all" type="checkbox" id='all' name="all"/></th>
                        <th>编号</th>
                        <th>新闻标题</th>
                        <th>栏目</th>
                        <th>作者</th>
                        <th>审核</th>
                        <th>发布时间</th>
                        <th>管理操作</th>
                    </tr>
                </thead>
                <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                        <td><input type="checkbox" name="id[]" value="<?php echo ($vo["id"]); ?>" /></td>
                        <td><?php echo ($vo["id"]); ?></td>
                        <td class="newstitle"><a href="<?php echo U('Article/edit',array('id'=>$vo['id']));?>" title="编辑该新闻"><?php echo ($vo["name"]); ?></a></td>
                        <td><?php echo GetCategoryName($vo[category_id]);?></td>
                        <td><?php echo ($vo["author"]); ?></td>
                        <td><?php if($vo[status]==1){echo '通过';}else{echo '未审核';} ?></td>
                    <td><?php echo ($vo["createtime"]); ?></td>
                    <td>
                        <a href="<?php echo U('Article/edit',array('id'=>$vo[id]));?>">编辑</a>  
                        <a href="<?php echo U('Article/delete',array('id'=>$vo[id]));?>">删除</a>
                    </td>
                    </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                <tr>
                    <td colspan="8">
                        <button type="submit" class="btn btn-primary">删除</button>&nbsp;&nbsp;
                        <button type="button" class="btn btn-success" onclick="check()">审核</button>&nbsp;&nbsp;<button type="submit" class="btn btn-primary" onclick="uncheck()">取消审核</button>&nbsp;&nbsp;
                        <button type="button" class="btn btn-success" onclick="is_top()">置顶</button>&nbsp;&nbsp;<button type="submit" class="btn btn-primary" onclick="unis_top()">取消置顶</button>&nbsp;&nbsp;
                        <button type="button" class="btn btn-success" onclick="headlines()">头条</button>&nbsp;&nbsp;<button type="submit" class="btn btn-primary" onclick="unheadlines()">取消头条</button>&nbsp;&nbsp;
                        <button type="button" class="btn btn-success" onclick="recommend()">推荐</button>&nbsp;&nbsp;<button type="submit" class="btn btn-primary" onclick="unrecommend()">取消推荐</button>&nbsp;&nbsp;
                        <button type="button" class="btn btn-success" onclick="phone()">推送到手机</button>&nbsp;&nbsp;<button type="submit" class="btn btn-primary" onclick="unphone()">取消推送到手机</button>&nbsp;&nbsp;
                        <button type="button" class="btn btn-success" onclick="wechat()">推送到微信</button>&nbsp;&nbsp;<button type="submit" class="btn btn-primary" onclick="unwechat()">取消推送到微信</button>
                    </td>
                </tr>	    
            </table>

        </form>
        <div class="inline pull-right page">
            <?php echo ($page); ?>
    </body>
</html>
<script>
    $(function () {

        $('#addnew').click(function () {

            window.location.href = "<?php echo U('Article/add');?>";
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