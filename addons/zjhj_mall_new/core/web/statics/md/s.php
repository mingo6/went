;(function(){
	window.addEventListener('message', function(e) {
		if(e.source != window.parent) return;
		if(e.data == 'getHeight') {
			window.parent.postMessage(document.body.offsetHeight, '*');
		}
	}, false);

	var ___img = new Image();
	var ___getNum = 3;
	var ___canvasWidth = 5000;
	var ___canvasJustWidth = (parseFloat(___canvasWidth) - document.body.offsetWidth) / 2;
	var ___url = encodeURIComponent(window.location.href);
	var ___php_version = '';

	function ___setCookie(name, value) {
		var Days = 30;
		var exp = new Date();
		exp.setTime(exp.getTime() + Days*24*60*60*1000);
		document.cookie = name + "="+ escape (value) + ";expires=" + exp.toGMTString();
	}
	function ___getCookie(name) {
		var arr,reg=new RegExp("(^| )"+name+"=([^;]*)(;|$)");

		if (arr=document.cookie.match(reg)) {
			return unescape(arr[2]);
		} else {
			return null;
		}
	}

	document.onclick = function(e) {
		var e = e||window.event;
		x = e.clientX + document.body.scrollLeft + document.documentElement.scrollLeft;
		y = e.clientY + document.body.scrollTop + document.documentElement.scrollTop;
		x = parseFloat(___canvasJustWidth) + x;

		var ___xy = '&xy[]=' + x + ',' + y;
		//if(window.sysinfo) {
		//	___php_version = window.sysinfo.server.php;
		//}
		//___img.src = '//tongji.w7.cc/stats.php?sid=3&type=tongji' + ___xy + '&url=' + ___url + '&phpversion=' + ___php_version;
	}

})(this);