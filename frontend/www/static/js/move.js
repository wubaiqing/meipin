/**
 * 浮层
 * @author wubaiqing
 */
var DRIFT = {};

/**
 * 浮层配置选
 */
DRIFT.CONFIG = {
    'version' : 1.0
}

/**
 * 浮层关闭方法
 */
DRIFT.GOSH = function () {
    return {
        'closeFlotage' : function () {
            $('#flotage-close-button').click(function () {
                $(this).prev().children().hide();
                $(this).children().hide();
            });
        }
    }
}

// 实例化浮层
var drift = DRIFT.GOSH();


/* ----------------------浮层方法结束--------------------------- */
// 下面代码整体优化。

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
	if(x<100){$("#gosh").hide();
	}else{
		$("#gosh").show().css("top",0).css("left",0);}
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

	$(window).scroll(function( ){
	var x = $(this).scrollTop();
	if(x<300){
		$(".image").hide();
		$(".X").hide();
	}else{
		$(".image").show().css("top",200).css("left","37%");
		$(".X").show().css("top",300).css("left","63%");}
	});

    // 关闭浮层
    drift.closeFlotage();

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
            obj.setAttribute("rel", "sidebar"); obj.title = title;
            // 关闭浮层
            $('#flotage-close-button').click();
        } else if (B.OP) {
            var a = document.createElement("a");
            a.rel = "sidebar", a.title = title, a.href = url;
            obj.parentNode.insertBefore(a, obj);
            a.appendChild(obj);
            a = null;
        }
    }
};	  