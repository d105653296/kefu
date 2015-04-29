function initArray(){
	this.length = initArray.arguments.length;
	for(var i=0;i<this.length;i++)
		this[i+1] = initArray.arguments[i];
}

function week() {
	var today = new Date();
	document.write(today.getFullYear(),"年",today.getMonth()+1,"月",today.getDate(),"日&nbsp;");
	var arrWeek = new initArray("星期日","星期一","星期二","星期三","星期四","星期五","星期六");
	document.write(arrWeek[today.getDay()+1]);
}

function time(){
	var Digital = new Date();
	var hours = Digital.getHours();
	var minutes = Digital.getMinutes();
	var seconds = Digital.getSeconds();
	if(minutes<=9)
		minutes="0"+minutes;
	if(seconds<=9)
		seconds="0"+seconds;
	var myClock = hours+":"+minutes+":"+seconds;
	if(document.layers){
		document.layers.liveclock.document.write(myclock);
		document.layers.liveclock.document.close();
	}else if(document.all)
		liveclock.innerHTML = myClock;
	setTimeout("time()",1000);
}