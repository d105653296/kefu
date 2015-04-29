<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
<html>
 <head>
  <title>让道网后台管理系统</title>
   <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
   <link href="/kefu/Public/Admin/assets/css/dpl-min.css" rel="stylesheet" type="text/css" />
  <link href="/kefu/Public/Admin/assets/css/bui-min.css" rel="stylesheet" type="text/css" />
   <link href="/kefu/Public/Admin/assets/css/main-min.css" rel="stylesheet" type="text/css" />
 </head>
 <body>

  <div class="header">
    
      <div class="dl-title">
        <a href="" title="" target="_blank"><!-- 仅仅为了提供文档的快速入口，项目中请删除链接 -->
          <span class="lp-title-port"></span><span class="dl-title-text"><img src="/kefu/Public/Admin/assets/img/logo.png"/></span>
        </a>
      </div>

      <div class="dl-log">欢迎您，<span class="dl-log-user"><?php echo ($_SESSION[username]); ?></span><a href="<?php echo U('Public/logout');?>" title="退出系统" class="dl-log-quit">[退出]</a><a href="/kefu" title="网站首页" target="_blank" class="dl-log-quit">网站首页</a>
    </div>
  </div>
   <div class="content">
    <div class="dl-main-nav">
      <div class="dl-inform"><div class="dl-inform-title">贴心小秘书<s class="dl-inform-icon dl-up"></s></div></div>
      <ul id="J_Nav"  class="nav-list ks-clear">
          
    
        <?php if(is_array($nav)): $i = 0; $__LIST__ = $nav;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li class="nav-item "><div class="nav-item-inner nav-order"><?php echo ($vo[title]); ?></div></li><?php endforeach; endif; else: echo "" ;endif; ?>
   
        
      </ul>
    </div>
    <ul id="J_NavContent" class="dl-tab-conten">

    </ul>
   </div>
  <script type="text/javascript" src="/kefu/Public/Admin/assets/js/jquery-1.8.1.min.js"></script>
  <script type="text/javascript" src="/kefu/Public/Admin/assets/js/bui.js"></script>
  <script type="text/javascript" src="./assets/js/config.js"></script>

  <script>
    BUI.use('common/main',function(){
      var config = [<?=Getgroup()?>{
            id : 'chart',
            menu : [{
              text : '图表',
              items:[
                  {id:'code',text:'引入代码',href:'chart/code.html'},
                  {id:'line',text:'折线图',href:'chart/line.html'},
                  {id:'area',text:'区域图',href:'chart/area.html'},
                  {id:'column',text:'柱状图',href:'chart/column.html'},
                  {id:'pie',text:'饼图',href:'chart/pie.html'}, 
                  {id:'radar',text:'雷达图',href:'chart/radar.html'}
              ]
            }]
          }];
      new PageUtil.MainPage({
        modulesConfig : config
      });
    });
  </script>
 </body>
</html>