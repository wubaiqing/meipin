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
                alert(result.data.message);
                return true;
            }
        }, 'json');
    });
});