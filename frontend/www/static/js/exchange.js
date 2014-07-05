var exchange = {};
exchange.numChange = function(obj) {
    var num = $("#num").val();
    if (!this.validNum(num)) {
        $("#num").val("1");
        return false;
    }
    if ($(obj).hasClass("jiahao")) {
        $("#num").val(parseInt(num) + 1);
    } else if ($(obj).hasClass("jianhao")) {
        $("#num").val((parseInt(num) - 1) <= 0 ? 1 : (parseInt(num) - 1));
    }
}
exchange.validNum = function(num) {
    var regx = /^\d+$/;
    if (!regx.test(num)) {
        alert("购买数量必须为正整数");
        x
        return false;
    }
    return true;
}
$(function() {
    try {
        $(".tb-tabbar").find("li").click(function() {
            $(".tb-tabbar").find("li").removeClass("selected");
            $(this).addClass("selected");
            $(".displayIF").addClass('hid');
            $("." + $(this).attr("id")).removeClass("hid");
        });
    } catch (e) {
        alert(e);
    }
    $('.goodcolor').find("a").click(function() {

        gdcolornum = $(this).attr("stock");
        if (gdcolornum != 0) {
            $(".goodcolor a").attr("style", '');
            gdcolor = $(this).html(); //颜色
            $(this).attr("style", "border: 2px solid red");
            $("#gdcolor").val(gdcolor);
        }
    });
    $(".jiahao,.jianhao").click(function() {
        exchange.numChange(this);
        return false;
    });

});
function checkcolor()
{
    var goods_type = $("#goods_type").val();
    if (goods_type != 1 && $("#gdcolor").val() == '')
    {
        alert('请选择一个型号');
        return false;
    }
    return true;
}