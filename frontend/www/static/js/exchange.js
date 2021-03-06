var exchange = {};
//点击数量后增减
exchange.numChange = function(obj) {
    var numObj = $("#num");
    if(numObj.attr("disabled") == 'disabled'){
        return false;
    }
    var valinum = this.validNum(numObj, obj);
    if (!valinum || obj == null || obj == undefined) {
        return valinum;
    }
    if ($(obj).hasClass("jiahao")) {
        var buyCount = parseInt(numObj.val()) + 1;
        numObj.val(buyCount);
    } else if ($(obj).hasClass("jianhao")) {
        var buyCount = (parseInt(numObj.val()) - 1) <= 0 ? 1 : (parseInt(numObj.val()) - 1);
        numObj.val(buyCount);
    }
    //计算总价
    var activePrice = $("#active_price").attr("price");
    var integral = $("#integral").attr("integral");
    if (activePrice != undefined) {
        var totalPrice = parseFloat(activePrice) * buyCount;
        $("#total_price").html(totalPrice.toFixed(2));
        $("#integral").html((parseInt(integral)* buyCount));
    }
}
//验证购买数量
exchange.validNum = function(numObj, obj) {
    var currCount = numObj.val();
    //alert(currCount);
    var regx = /^\d+$/;
    if (!regx.test(currCount)) {
        alert("购买数量必须为正整数");
        return false;
    }
    //var limitNum = numObj.attr("limitnum");
    var kckc_id = $("#kckc_id").html();
    var xg_num = $("#xg_num").html();
    if(parseInt(kckc_id) < parseInt(xg_num))
    {
       var limitNum = parseInt(kckc_id);
    }else
    {
        var limitNum = parseInt(xg_num);
    }

    if ($(obj).hasClass("jiahao")) {
        if (parseInt(currCount) >= parseInt(limitNum) - 1) {
            $(".jiahao").addClass("color_gray");
            numObj.val(limitNum);
            $("#leixing").html("超出库存或超出限制购买件数");
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
        $("." + id).removeClass("show_none");
    });
}
//滚动条滚动后浮动显示
exchange.scrollView = function() {
    var popPosition = $("hgroup").offset().top;
    var scrollbar = $(document).height() - $(window).height();
    if (scrollbar == popPosition) {
        $("hgroup").addClass("fixed");
    } else {
        $("hgroup").removeClass("fixed");
    }
}
//验证加钱购买
exchange.checkMoneyBuy = function() {

    if($("#is_gdcolor").length>0)
    {
        var colorSel = checkcolor();
        if (!colorSel) {
            return false;
        }
    } 
    if($("#num").val() < 1){
        alert("购买数量必须大于0");
        return false;
    }
    return this.numChange();
}
//默认选中选型
exchange.defaultColor = function() {
    var selectedColor = $.trim($("#gdcolor").val());
    if ($.trim($("#gdcolor").val()) != "") {
        $(".goodcolor a").each(function() {
            if ($.trim($(this).html()) == selectedColor) {
                $(this).attr("style", "border: 2px solid red");
            }
        });
    }
}
//支付弹出框
exchange.payPop = function(){
        var index = 1;
        $(".pay_btn").click(function() {
            index = layer.tab({
                area: ['400px', '240px'],
                data: [
                    {title: '确认支付结果', content: $("#pay_confirm").html()}
                ]
            });
            $(".btn_pay_no").unbind('click');
            $(".btn_pay_no").on('click',function(){
                layer.close(index);
            });
        });
}
$(function() {
    exchange.defaultColor();
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
        if($(this).hasClass("disabled")){
            return false;
        }
        gdcolornum = $(this).attr("stock");
        if (gdcolornum != 0) {
            $(".goodcolor a").attr("style", '');
            gdcolor = $(this).html(); //颜色
            $("#leixing").html('');
            $("#num").val('1');
            $(this).attr("style", "border: 2px solid red");
            $("#gdcolor").val($.trim(gdcolor));
            $("#kckc_id").html(gdcolornum);
            $("#zhkc").val(gdcolornum);
        }
    });
    $(".jiahao,.jianhao").on('click', function() {
        exchange.numChange(this);
        return false;
    });
    $("#num").blur(function() {
        exchange.numChange();
    });
    //加钱购买详情
    exchange.moneyExchangePopDiv();
    $(window).scroll(function() {
        exchange.scrollView();
    });
    //支付弹出框
    exchange.payPop();
});
function checkcolor()
{
    var goods_type = $("#goods_type").val();
    if (goods_type != 1 && $("#gdcolor").val() == '')
    {
        //alert('请选择一个型号');
        $("#leixing").html('请选择一个型号');
        return false;
    }
    //         //先判断是否登陆
    // url = "/exchange/Islogin";
    // idid = $("#gdid").val();
    // $.post(url, {id:idid}, function(d) {
    //     alert(d)
    //    if(d)
    //     { window.location.href=d;}
    // });
    return true;
}