/*积分签到*/
$(function() {
    $('.qiandao').click(function(){
        var input = this;
        var signApi = '/user/DayRegistion';
        if($(input).hasClass("signed")){
            return false;
        }
        $.get(signApi, {}, function(result) {
            if (result.status == false) {
                //未登录
                if (!result.data.isLogin) {
                    window.location.href = $('#unlogin_url').val();
                }else{
                    alert(result.data.message);
                    $('.qiandao').removeClass('unsign').addClass('signed');
                }
                return false;
            } else {
                alert(result.data.message);
                //成功提示
                $("#dr_count").html(result.data.dr_count);
                $("#nowScore").html(result.data.score);
                $("#nextCount").html(result.data.nextScore);
                $(".qd").addClass("qd_ok");
                $('.qiandao').removeClass('unsign').addClass('signed');
                return true;
            }
        }, 'json');
    });
});