<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>提示信息</title>
<style type="text/css">
*{ padding: 0; margin: 0; }
body{  font-family: '微软雅黑'; color: #d90404; font-size: 15px; }
.system-message{ padding: 24px 48px; }
.system-message h1{ font-size: 30px; font-weight: normal; line-height: 34px; margin-bottom: 12px }
.system-message .jump{ margin-bottom:20px}
.system-message .jump a{ color: #333;}
.system-message .success,.system-message .error{ line-height: 1.8em; font-size: 20px }
.system-message .detail{ font-size: 12px; line-height: 20px; margin-top: 12px; display:none}

#backgroundPopup{
display:none;
position:fixed;
_position:absolute;
height:100%;
width:100%;
top:0;
left:0;
background:#000000;
border:1px solid #cecece;
z-index:1;
}
#popupContact{
display:none;
position:fixed;
_position:absolute;
height:226px;
width:398px;
background:#fff;
z-index:2;
padding:12px;
}
#popupContactClose{
right:6px;
top:4px;
position:absolute;
display:block;
cursor:pointer;
}
#wait {
    font-size:38px;
}
#btn-stop,#href{
    display: inline-block;
    margin: 0 21px;
    font-size: 16px;
    line-height: 18px;
    text-align: center;
    vertical-align: middle;
    cursor: pointer;
    border: 0 none;
    background-color: #d90404;
    padding: 10px 20px;
    color: #fff;
    font-weight: bold;
    border-color: transparent;
    text-decoration:none;
}

#btn-stop:hover,#href:hover{
    background-color: #ff0000;
}
</style>
<script src="/kefu/Public/Home/js/jquery-1.8.0.min.js" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function(){
	//初始化：是否开启DIV弹出窗口功能
	//0 表示开启; 1 表示不开启;
	var popupStatus = 0;
	//使用Jquery加载弹窗
	function loadPopup(){
	//仅在开启标志popupStatus为0的情况下加载
	if(popupStatus==0){
		$("#backgroundPopup").css({
			"opacity": "0.7"
		});
		$("#backgroundPopup").fadeIn("slow");
		$("#popupContact").fadeIn("slow");
		popupStatus = 1;
		}
	}
	//使用Jquery去除弹窗效果
	function disablePopup(){
	//仅在开启标志popupStatus为1的情况下去除
		if(popupStatus==1){
				$("#backgroundPopup").fadeOut("slow");
				$("#popupContact").fadeOut("slow");
				popupStatus = 0;
			}
	}
	//将弹出窗口定位在屏幕的中央
	function centerPopup(){
	//获取系统变量
		var windowWidth = document.documentElement.clientWidth;
		var windowHeight = document.documentElement.clientHeight;
		var popupHeight = $("#popupContact").height();
		var popupWidth = $("#popupContact").width();
		//居中设置
		$("#popupContact").css({
			"position": "absolute",
			"top": windowHeight/2-popupHeight/2,
			"left": windowWidth/2-popupWidth/2
		});
		//以下代码仅在IE6下有效

		$("#backgroundPopup").css({
			"height": windowHeight
		});
	}

	//打开弹出窗口
        //调用函数居中窗口
		centerPopup();
		//调用函数加载窗口
		loadPopup();
	//按钮点击事件!

	$("#button").click(function(){
		//调用函数居中窗口
		centerPopup();
		//调用函数加载窗口
		loadPopup();
	});
	//关闭弹出窗口
	//点击"X"所触发的事件
	$("#popupContactClose").click(function(){
			disablePopup();
	});
	//点击窗口以外背景所触发的关闭窗口事件!
	$("#backgroundPopup").click(function(){
		disablePopup();
	});
	//键盘按下ESC时关闭窗口!
	$(document).keypress(function(e){
		if(e.keyCode==27 && popupStatus==1){
			disablePopup();
		}
	});


});

</script>
</head>
<body>
    <div id="popupContact">
        <a id="popupContactClose">x</a>
            <div class="system-message">
            <h1>抱歉,出错啦!</h1>
            <p class="error"><?php echo($error); ?></p>
            <p class="detail"></p>
            <p class="jump">
            <b id="wait"><?php echo($waitSecond); ?></b> 秒后页面将自动跳转
            </p>
            <div>
                <a id="href" id="btn-now" href="<?php echo($jumpUrl); ?>">立即跳转</a>
                <button id="btn-stop" type="button" onclick="stop()">停止跳转</button>
            </div>
            </div>
           </div>
    <div id="backgroundPopup"></div>
<script type="text/javascript">
(function(){
 var wait = document.getElementById('wait'),href = document.getElementById('href').href;
 var interval = setInterval(function(){
     	var time = --wait.innerHTML;
     	if(time <= 0) {
     		location.href = href;
     		clearInterval(interval);
     	};
     }, 1000);
  window.stop = function (){
         console.log(111);
            clearInterval(interval);
 }
 })();
</script>
</body>
</html>