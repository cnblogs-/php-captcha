window.onload = function () {
	var code = document.getElementById('codeimg');//通过id找到html中img标签
	code.onclick = function () {//为标签添加点击事件
		this.src='codeimg.php?tm='+Math.random();//修改时间，重新指向codeimg.php
	};	
}