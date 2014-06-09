$(document).ready(function(e) {
	$("#nav p").hover(function(){
    $(this).find("span").show();
	$(this).find("a img").hide();
		},function(){
	$(this).find("span").hide();
	$(this).find("a img").show();
	});
    
	$(window).scroll(function( ){
	var x = $(this).scrollTop();
	if(x<100){$("#class_new").hide();
	}else{
		$("#class_new").show().css("top",0);}
	});
	
	
	$(".X").hide();
	$(window).scroll(function( ){
	var x = $(this).scrollTop();
	if(x<300){
		$(".image").hide();
			$(".X").hide();
		$(".X").hide();
	}else{
		$(".image").show().css("top",200).css("left",600);
		$(".X").show().css("top",300).css("left",550);}
	}); 
	
	$(".X").click(function(){
		$(this).prev().hide();
		$(this).hide();
	});
});
//首页收藏
$(document).ready(function(e) {
	$("#nav p").hover(function(){
    $(this).find("span").show();
	$(this).find("a img").hide();
		},function(){
	$(this).find("span").hide();
	$(this).find("a img").show();
	});
    
	$(window).scroll(function( ){
	var x = $(this).scrollTop();
	if(x<100){$("#class_new").hide();
	}else{
		$("#class_new").show().css("top",0);}
	});
	
	
	$(".X").hide();
	$(window).scroll(function( ){
	var x = $(this).scrollTop();
	if(x<300){
		$(".image").hide();
		$(".X").hide();
	}else{
		$(".image").show().css("top",200).css("left","40%");
		$(".X").show().css("top",300).css("left","40%");}
	}); 
	
	$(".X").click(function(){
		$(this).prev().hide();
		$(this).hide();
	});
});

//首页收藏 JS 方法
var www_meipin_com = function (obj, url, title) {
    var e = window.event || arguments.callee.caller.arguments[0];
    var B = {
        IE : /MSIE/.test(window.navigator.userAgent) && !window.opera
        , FF : /Firefox/.test(window.navigator.userAgent)
        , OP : !!window.opera
    };
    obj.onmousedown = null;
    if (B.IE) {
        obj.attachEvent("onmouseup", function () {
            try {
                window.external.AddFavorite(url, title);
                window.event.returnValue = false;
            } catch (exp) {}
        });
    } else {
        if (B.FF || obj.nodeName.toLowerCase() == "a") {
            obj.setAttribute("rel", "sidebar"), obj.title = title, obj.href = url;
        } else if (B.OP) {
            var a = document.createElement("a");
            a.rel = "sidebar", a.title = title, a.href = url;
            obj.parentNode.insertBefore(a, obj);
            a.appendChild(obj);
            a = null;
        }
    }
};	  