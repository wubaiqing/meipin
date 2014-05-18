/*积分签到*/
$(function() {
    $('.qiandao').click(function(){
        var signApi = '/user/DayRegistion';
        $.get(signApi, {}, function(result) {
            if (result.status == false) {
                //未登录
                if (!result.data.isLogin) {
                    window.location.href = $('#unlogin_url').val();
                }
                return false;
            } else {
                //成功提示
                $("#dr_count").html(result.data.dr_count);
                $("#nowScore").html(result.data.score);
                $("#nextCount").html(result.data.nextScore);
                $(".qd").addClass("qd_ok");
                return true;
            }
        }, 'json');
    });
});