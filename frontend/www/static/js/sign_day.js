
/* by zhangxinxu 2010-07-27 
 * http://www.zhangxinxu.com/
 * 倒计时的实现 
 * edit by liukui@ttmzk.com 2014-06-07
 */
var fnTimeCountDown = function(d, o, url, t) {
    var f = {
        zero: function(n) {
            var n = parseInt(n, 10);
            if (n > 0) {
                if (n <= 9) {
                    n = "0" + n;
                }
                return String(n);
            } else {
                return "00";
            }
        },
        dv: function() {

            d = d || Date.UTC(2050, 0, 1); //如果未定义时间，则我们设定倒计时日期是2050年1月1日
            var future = new Date(d), now = new Date();

            //现在将来秒差值
            var dur = Math.round((future.getTime() - now.getTime()) / 1000), pms = {
                sec: "00",
                mini: "00",
                hour: "00",
                day: "00",
                month: "00",
                year: "0"
            };
            if (dur > 0) {
                pms.sec = f.zero(dur % 60);
                pms.mini = Math.floor((dur / 60)) > 0 ? f.zero(Math.floor((dur / 60)) % 60) : "00";
                pms.hour = Math.floor((dur / 3600)) > 0 ? f.zero(Math.floor((dur / 3600)) % 24) : "00";
                pms.day = Math.floor((dur / 86400)) > 0 ? f.zero(Math.floor((dur / 86400))) : "00";
            }
            return pms;
        },
        ui: function() {
            var str = "剩余：";
            str += "<b>" + f.dv().day + "</b>天";
            str += "<b>" + f.dv().hour + "</b>小时";
            str += "<b>" + f.dv().mini + "</b>分";
            str += "<b>" + f.dv().sec + "</b>秒";
            if (f.dv().sec == '00' && f.dv().mini == '00' && f.dv().hour == '00' && f.dv().day == '00') {
                $(o).html("<a href=" + url + " target='_blank'>查看结果>><a>");
            } else {
                $(o).html(str);
            }
            setTimeout(f.ui, 1000);
        },
        uiDetail: function() {
            var str = "";
            $(o).find("i").html(f.dv().day);
            $(o).find("em.one").html(f.dv().hour);
            $(o).find("em.two").html(f.dv().mini);
            $(o).find("em.three").html(f.dv().sec);
//            str += "<em class='one'>" + f.dv().hour + "</em>";
//            str += "<em class='two'>" + f.dv().mini + "</em>分";
//            str += "<em class='three'>" + f.dv().sec + "</em>秒";
            setTimeout(f.uiDetail, 1000);
        }
    };
    if (!t) {
        f.ui();
    }else if(t == 'detail'){
        f.uiDetail();
    }
};

/*积分签到*/
$(function() {
    $('.qiandao').click(function() {
        var input = this;
        var signApi = '/user/DayRegistion';
        if ($(input).hasClass("signed")) {
            return false;
        }
        $.get(signApi, {}, function(result) {
            if (result.status == false) {
                //未登录
                if (!result.data.isLogin) {
                    window.location.href = $('#unlogin_url').val();
                } else {
                    alert(result.data.message);
                }
                return false;
            } else {
                alert(result.data.message);
                // $('.qiandao').removeClass('unsign').addClass('signed').removeClass('qiandao');
                if ($("#jryq").length > 0)
                {
                    $("#jryq").html(result.data.message2);
                }

                if ($("#jryq2").length > 0)
                {
                    //积分签到更改 样式和文字
                    $("#jryq2").attr('class', 'J_qiandao cheng signed');
                    $("#jryq2").html(result.data.message2);
                }

                //成功提示
                $("#dr_count").html(result.data.dr_count);
                $("#nowScore").html(result.data.score);
                $("#nextCount").html(result.data.nextScore);
                return true;
            }
        }, 'json');
    });
    $('.cheng').click(function() {
        alert("您已经签过了");
    });
    //倒计时
    $("p.time").each(function(i) {
        var str = $(this).attr("date").toString();
        str = str.replace(/-/g, "/");
        var d = new Date(str);
        fnTimeCountDown(d, $(this).find("em"), $(this).attr("url"));
    });
});