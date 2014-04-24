/*!
 * jQuery JavaScript Library v1.4.4
 * http://jquery.com/
 *
 * Copyright 2010, John Resig
 * Dual licensed under the MIT or GPL Version 2 licenses.
 * http://jquery.org/license
 *
 * Includes Sizzle.js
 * http://sizzlejs.com/
 * Copyright 2010, The Dojo Foundation
 * Released under the MIT, BSD, and GPL Licenses.
 *
 * Date: Thu Nov 11 19:04:53 2010 -0500
 */
function addToFavorite(){var a="http://www.meipin.com/";var b="美品网-独家折扣优惠";if(document.all){window.external.AddFavorite(a,b)}else if(window.sidebar){window.sidebar.addPanel(b,a,"")}else{alert("对不起，您的浏览器不支持此操作!\n请您使用菜单栏或Ctrl+D收藏本站。")}}
var TINY={};function T$(i){return document.getElementById(i)}
TINY.box=function(){var p,m,b,fn,ic,iu,iw,ih,ia,f=0;return{show:function(c,u,w,h,a,t){c=T$('showjs').innerHTML;if(!f){p=document.createElement('div');p.id='loginbox';m=document.createElement('div');m.id='loginmask';b=document.createElement('div');b.id='logincontent';document.body.appendChild(m);document.body.appendChild(p);p.appendChild(b);}
if(!a&&!u){p.style.width=w?w+'px':'auto';p.style.height=h?h+'px':'auto';p.style.backgroundImage='none';b.innerHTML=document.getElementById('showjs').innerHTML;}else{b.style.display='none';p.style.width=p.style.height='100px'}
this.mask();ic=c;iu=u;iw=w;ih=h;ia=a;this.alpha(m,1,60,1);if(t){setTimeout(function(){TINY.box.hide()},1000*t)}},fill:function(c,u,w,h,a){if(u){p.style.backgroundImage='';var x=window.XMLHttpRequest?new XMLHttpRequest():new ActiveXObject('Microsoft.XMLHTTP');x.onreadystatechange=function(){if(x.readyState==4&&x.status==200){TINY.box.psh(x.responseText,w,h,a)}};x.commonopen('GET',c,1);x.send(null)}else{this.psh(c,w,h,a)}},psh:function(c,w,h,a){if(a){if(!w||!h){var x=p.style.width,y=p.style.height;b.innerHTML=c;p.style.width=w?w+'px':'';p.style.height=h?h+'px':'';b.style.display='';w=parseInt(b.offsetWidth);h=parseInt(b.offsetHeight);b.style.display='none';p.style.width=x;p.style.height=y;}else{b.innerHTML=c}
this.size(p,w,h,4)}else{p.style.backgroundImage='none'}},hide:function(){TINY.box.alpha(p,-1,0,1);var l=document.getElementsByTagName("select");for(var i=0;i<l.length;i++){l[i].style.display="inline";}},resize:function(){TINY.box.pos();TINY.box.mask()},mask:function(){m.style.height=TINY.page.theight()+'px';m.style.width='';m.style.width=TINY.page.twidth()+'px'},pos:function(){var t=(TINY.page.height()/2)-(p.offsetHeight/2);t=t<10?10:t;p.style.top=(t+TINY.page.top())+'px';p.style.left=(TINY.page.width()/2)-(p.offsetWidth/2)+'px'},alpha:function(e,d,a,s){clearInterval(e.ai);if(d==1){e.style.opacity=0;e.style.filter='alpha(opacity=0)';e.style.display='block';this.pos()}
e.ai=setInterval(function(){TINY.box.twalpha(e,a,d,s)},20)},twalpha:function(e,a,d,s){var o=Math.round(e.style.opacity*100);if(o==a){clearInterval(e.ai);if(d==-1){e.style.display='none';e==p?TINY.box.alpha(m,-1,0,2):b.innerHTML=p.style.backgroundImage=''}else{e==m?this.alpha(p,1,100,2):TINY.box.fill(ic,iu,iw,ih,ia)}}else{var n=o+Math.ceil(Math.abs(a-o)/s)*d;e.style.opacity=n/100;e.style.filter='alpha(opacity='+n+')'}},size:function(e,w,h,s){e=typeof e=='object'?e:T$(e);clearInterval(e.si);var ow=e.offsetWidth,oh=e.offsetHeight,wo=ow-parseInt(e.style.width),ho=oh-parseInt(e.style.height);var wd=ow-wo>w?-1:1,hd=(oh-ho>h)?-1:1;e.si=setInterval(function(){TINY.box.twsize(e,w,wo,wd,h,ho,hd,s)},20)},twsize:function(e,w,wo,wd,h,ho,hd,s){var ow=e.offsetWidth-wo,oh=e.offsetHeight-ho;if(ow==w&&oh==h){clearInterval(e.si);p.style.backgroundImage='none';b.style.display='block'}else{if(ow!=w){e.style.width=ow+(Math.ceil(Math.abs(w-ow)/s)*wd)+'px'}
if(oh!=h){e.style.height=oh+(Math.ceil(Math.abs(h-oh)/s)*hd)+'px'}
this.pos()}}}}();TINY.page=function(){return{top:function(){return document.body.scrollTop||document.documentElement.scrollTop},width:function(){return self.innerWidth||document.documentElement.clientWidth},height:function(){return self.innerHeight||document.documentElement.clientHeight},theight:function(){var d=document,b=d.body,e=d.documentElement;return Math.max(Math.max(b.scrollHeight,e.scrollHeight),Math.max(b.clientHeight,e.clientHeight))},twidth:function(){var d=document,b=d.body,e=d.documentElement;return Math.max(Math.max(b.scrollWidth,e.scrollWidth),Math.max(b.clientWidth,e.clientWidth))}}}();var online=new Array();var onlineqq='';var offlineqq='';var tab=document.getElementsByTagName("a");var tabs=document.getElementsByTagName("input");for(var i=0;i<tabs.length;i++){tabs[i].onclick="commonopen()";}
var tabs=document.getElementsByTagName("button");for(var i=0;i<tabs.length;i++){tabs[i].onclick="commonopen()";}
var tab=document.getElementsByTagName("a");var tabs=document.getElementsByTagName("form");for(var i=0;i<tabs.length;i++){tabs[i].action="javascript:;";tabs[i].target="_self";}
function commonopen(){var l=document.getElementsByTagName("select");for(var i=0;i<l.length;i++){l[i].style.display="none";}
TINY.box.show('',0,0,0,0)}
function H$(i){return document.getElementById(i)}
function H$$(c,p){return p.getElementsByTagName(c)}
var slider=function(){function init(o){this.id=o.id;this.at=o.auto?o.auto:3;this.o=0;this.pos();}
init.prototype={pos:function(){clearInterval(this.__b);this.o=0;var el=H$(this.id),li=H$$('li',el),l=li.length;var _t=li[l-1].offsetHeight;var cl=li[l-1].cloneNode(true);cl.style.opacity=0;cl.style.filter='alpha(opacity=0)';el.insertBefore(cl,el.firstChild);el.style.top=-_t+'px';this.anim();},anim:function(){var _this=this;this.__a=setInterval(function(){_this.animH()},20);},animH:function(){var _t=parseInt(H$(this.id).style.top),_this=this;if(_t>=-1){clearInterval(this.__a);H$(this.id).style.top=0;var list=H$$('li',H$(this.id));H$(this.id).removeChild(list[list.length-1]);this.__c=setInterval(function(){_this.animO()},20);}else{var __t=Math.abs(_t)-Math.ceil(Math.abs(_t)*.07);H$(this.id).style.top=-__t+'px';}},animO:function(){this.o+=2;if(this.o==100){clearInterval(this.__c);H$$('li',H$(this.id))[0].style.opacity=1;H$$('li',H$(this.id))[0].style.filter='alpha(opacity=100)';this.auto();}else{H$$('li',H$(this.id))[0].style.opacity=this.o/100;H$$('li',H$(this.id))[0].style.filter='alpha(opacity='+this.o+')';}},auto:function(){var _this=this;this.__b=setInterval(function(){_this.pos()},this.at*1000);}}
return init;}();function copyurl()
{var share_url=document.getElementById("sharetext").value;if(window.clipboardData){window.clipboardData.setData("Text",share_url);alert("推荐代码已经复制到粘贴板!");}else{alert("该浏览器不支持快捷复制，请使用CTR+C手动复制内容!");}}
function add_cookie($key,$value,$hours){var $str=$key+"="+$value;if($hours>0){var $date=new Date();var $ms=$hours*3600*1000;$date.setTime($date.getTime()+$ms);$str+="; path=/; expires="+$date.toGMTString();}
document.cookie=$str;}
function get_cookie($objname){var $arr=document.cookie.split(";");for(var $i=0;$i<$arr.length;$i++){var $str=$arr[$i].split("=");if($.trim($str[0])==$objname){return $.trim($str[1]);}}
return"";}
function F_shortcut(){$shortcut=get_cookie('shortcut');if($shortcut!="no"){$html='<div class="index_collection"><div class="top"><div class="area"><p onclick="javascript:F_close_shortcut();">关闭</p>按 <strong>Ctrl+D</strong>，将<em>VIP800</em>加入收藏夹或者<a href="http://www.vip800.com/shortcut.php" id="btn_bc">下载快捷方式到桌面</a><span><a href="javascript:void(0)" onclick="javascript:F_no_shortcut();">不再提醒</a></span></div></div></div>';$("#header").prepend($html);}}
function F_no_shortcut(){add_cookie("shortcut","no",24*7);$(".index_collection").attr("style","display:none;");}
function F_close_shortcut(){add_cookie("shortcut","no",0);$(".index_collection").attr("style","display:none;");}
function F_sign(){$.ajax({url:"/sign/index.html",type:"get",cache:false,dataType:"json",success:function($data){if($data.status=="0"){$("#sign").html($data.msg);}else{$("#sign").html($data.data);}},error:function($data){$("#sign").html("error");}});}
function F_ajax_sign(){$.ajax({url:"/sign/sign.html",type:"POST",cache:false,dataType:"json",success:function($data){if($data.status=="0"){alert($data.msg);}else{$("#ajax_sign").attr("class","qd qd_ok");$("#ajax_sign").attr("onclick","");$("#ajax_sign").html($data.data);}},error:function(){alert("出错，请重试");}});}
function F_dlogin_form(){$pd="username="+$("#logincontent #J_username").val();$pd+="&password="+$("#logincontent #J_password").val();$pd+="&captcha="+$("#logincontent #J_captcha").val();$pd+="&remember="+$("#logincontent #J_remember").val();if($pd=='username=undefined&password=undefined&captcha=undefined&remember=undefined'){return true;}
$.ajax({url:"/user/login.html",type:"POST",data:$pd,cache:false,dataType:"json",success:function($data){if($data.status=="0"){alert($data.msg);return false;}else{window.location.reload()}}});return false;}
function F_ddlogin_form(){$pd="username="+$("#logincontent #J_username").val();$pd+="&password="+$("#logincontent #J_password").val();$pd+="&captcha="+$("#logincontent #J_captcha").val();$pd+="&remember="+$("#logincontent #J_remember").val();if($pd=='username=undefined&password=undefined&captcha=undefined&remember=undefined'){return true;}
$.ajax({url:"index.php/user/login_check",type:"POST",data:$pd,cache:false,dataType:"json",success:function($data){if($data.status=="0"){alert($data.msg);return false;}else{return true;}}});}
function u_report(id){$.ajax({url:"index.php/sign/u_report",type:"POST",async:false,data:{item_id:id},cache:false,dataType:"json",success:function($data){if($data.data==2){alert('此产品正在举报处理中。。。');}
if($data.data==1){commonopen();}
if($data.data==0){if(confirm('您确定要举报该宝贝吗？')){window.open('/report/'+id+'.html');}}}});};
