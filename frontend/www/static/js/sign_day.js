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
                }
                return false;
            } else {
                alert(result.data.message);
                // $('.qiandao').removeClass('unsign').addClass('signed').removeClass('qiandao');
                if ( $("#jryq").length > 0 ) 
                { 
                  $("#jryq").html("今日已签&nbsp;&nbsp;&nbsp;&nbsp;"); 
                } 

                if ( $("#jryq2").length > 0 ) 
                { 
                  //积分签到更改 样式和文字
                  $("#jryq2").attr('class','J_qiandao cheng signed');
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
    $('.cheng').click(function(){
        alert("您已经签过了");
    });
});