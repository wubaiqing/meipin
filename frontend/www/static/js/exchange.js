var exchange = {};
exchange.numChange = function(obj) {
    var numObj = $("#num");
    if (!this.validNum(numObj, obj)) {
        return false;
    }
    if ($(obj).hasClass("jiahao")) {
        var currCount = parseInt(numObj.val()) + 1;
        numObj.val(currCount);
    } else if ($(obj).hasClass("jianhao")) {
        numObj.val((parseInt(numObj.val()) - 1) <= 0 ? 1 : (parseInt(numObj.val()) - 1));
    }
}
exchange.validNum = function(numObj, obj) {
    var currCount = numObj.val();
    var regx = /^\d+$/;
    if (!regx.test(currCount)) {
        alert("购买数量必须为正整数");
        return false;
    }
    var limitNum = numObj.attr("limitnum");
    if ($(obj).hasClass("jiahao")) {
        if (parseInt(currCount) >= parseInt(limitNum) - 1) {
            $(".jiahao").addClass("color_gray");
            numObj.val(limitNum)
            return false;
        }
    } else if ($(obj).hasClass("jianhao")) {
        $(".jiahao").removeClass("color_gray");
    }
    return true;
}

exchange.moneyExchangePopDiv = function() {
    $(".mainwrap p span").on('click', function() {
        $(".mainwrap p span").removeClass("cur");
        var id = $(this).addClass("cur").attr("id");
        $(".dtl").addClass("show_none")
        $("."+id).removeClass("show_none");
    });
}
exchange.scrollView = function() {
    var popPosition = $("hgroup").offset().top;
    var scrollbar = $(document).height() - $(window).height();
    if (scrollbar == popPosition) {
        $("hgroup").addClass("fixed");
    } else {
        $("hgroup").removeClass("fixed");
    }
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
    $(".jiahao,.jianhao").on('click', function() {
        exchange.numChange(this);
        return false;
    });
    $("#num").blur(function() {
        exchange.numChange($(".jiahao"));
    });
    //加钱购买详情
    exchange.moneyExchangePopDiv();
    $(window).scroll(function() {
        exchange.scrollView();
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