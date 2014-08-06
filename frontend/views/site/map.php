<script>
document.domain = "meipin.com";
</script>
<script>
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
    }
</script>

<div class="endmap"><div style="width:1000px; margin:0px auto;position:relative;"><img src="/static/images/endmap.jpg" usemap="#endMap" border="0" height="70" width="931" /><span class="mailodlist"><div class="rssbook light " style="width:auto "><div class="mailInput"></div></div></span></div>
<span style="display:none"><map name="endMap" id="endMap">
     <area shape="rect" coords="342,20,500,176" href="javascript:void(0);"onMouseDown="www_meipin_com(this, 'http://www.meipin.com', '美品网，畅想折扣新主张！')" target="_blank">
    <area shape="rect" coords="500,20,700,176" href="http://g.meipin.com/site/xiazai" target="_self">
    <area shape="rect" coords="677,21,992,174" href="http://meipin.com/site/phone" target="_blank">

  </map></span></div>
</div>