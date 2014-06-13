//加载页面判断是否存在COOKIE
$(document).ready(function(){
	 if(getCookie('test')=='meipin'){
				$('#my_book').hide();
			}else{
				$('#my_book').show();
			}
 })
//点击获取cookie
$('#my_book').click(function(){
	if(getCookie('test')=='meipin'){
			$('#my_book').hide();
		}else{
			$('#my_book').show();
			var time_day=60*24*60*60;//30天生存时间
			setCookie("test","meipin",time_day);  
		}
 });
//读取COOKIE
function getCookie(name) {    
 var nameEQ = name + "=";    
 var ca = document.cookie.split(';');    //把cookie分割成组    
 for(var i=0;i < ca.length;i++) {    
	 var c = ca[i];                      //取得字符串    
	 while (c.charAt(0)==' ') {          //判断一下字符串有没有前导空格    
		c = c.substring(1,c.length);      //有的话，从第二位开始取    
	 }    
	 if (c.indexOf(nameEQ) == 0) {       //如果含有我们要的name    
		return unescape(c.substring(nameEQ.length,c.length));    //解码并截取我们要值    
	 }    
 }    
	return false;    
} 
//设置COOKIE
function setCookie(name, value, seconds) {    
 seconds = seconds || 0;   //seconds有值就直接赋值，没有为0，这个根php不一样。    
 var expires = "";    
 if (seconds != 0 ) {      //设置cookie生存时间    
	 var date = new Date();    
	 date.setTime(date.getTime()+(seconds*1000));    
	 expires = "; expires="+date.toGMTString();    
 }    
	document.cookie = name+"="+escape(value)+expires+"; path=/";   //转码并赋值    
} 
  
document.onkeydown = function (e) {
            e = e || event;
            if (e.keyCode == 13) {  //判断是否单击的enter按键(回车键)
                //document.getElementByIdx_x_x("txtid").click();
				alert('44444');
                return false;
            }
   }
   
