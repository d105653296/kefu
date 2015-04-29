// JavaScript Document
$(function(){
	var left = $("#left");
	var right = $("#right");
	var obj = $(".scroll ul");
	var w = obj.find("li").innerWidth();
	
	left.click(function(){
		obj.find("li:last").prependTo(obj);
		obj.css("margin-left",-w);
		obj.animate({"margin-left": 0});
	});
	
	right.click(function(){
		obj.animate({"margin-left": -w},function(){
			obj.find("li:first").appendTo(obj);
			obj.css("margin-left","0");
		});
	});
	
	var moving = setInterval(function(){right.click()},3000);
	
	obj.hover(function(){
		clearInterval(moving);
	},function(){
		moving = setInterval(function(){right.click()},3000);
	})
	
});

 
    //加入收藏
 
        function AddFavorite(sURL, sTitle) {
 
            sURL = encodeURI(sURL); 
        try{   
 
            window.external.addFavorite(sURL, sTitle);   
 
        }catch(e) {   
 
            try{   
 
                window.sidebar.addPanel(sTitle, sURL, "");   
 
            }catch (e) {   
 
                alert("加入收藏失败，请使用Ctrl+D进行添加,或手动在浏览器里进行设置.");
 
            }   
 
        }
 
    }
 
    //设为首页
 
    function SetHome(url){
 
        if (document.all) {
 
            document.body.style.behavior='url(#default#homepage)';
 
               document.body.setHomePage(url);
 
        }else{
 
            alert("您好,您的浏览器不支持自动设置页面为首页功能,请您手动在浏览器里设置该页面为首页!");
 
        }
 

    }
 
