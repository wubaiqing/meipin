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
});
function checkcolor()
{
    var goods_type = $("#goods_type").val();
    if (goods_type !=1 && $("#gdcolor").val() == '')
    {
        alert('请选择一个型号');
        return false;
    }
    return true;
}