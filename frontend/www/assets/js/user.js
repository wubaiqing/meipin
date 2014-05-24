var User = {};
User.Config = {
    'version': 1.0
};
var iID;
User.Address = (function() {
    return {
        'changeProvince': function() {
            var url = $('#getProvinceUrl').val();
            $('#userProvince').change(function() {
                $('#userCity').attr('disabled', 'disabled');
                $.getJSON(url, {'provinceId': $(this).val()}, function(json) {
                    if (json.status == 0) {
                        return false;
                    }
                    $('#userCity').html(json.data);
                    $('#userCity').removeAttr('disabled');
                });
            });
        },
        //发送手机绑定验证码
        'sendMobileBindSmsCode': function() {
            var input = this;
            $(".sendBtn").click(function() {
                //发送短信验证码
                var url = $(this).attr("url");
                var params = {
                    'UsersAddress[mobile]': $("#UsersAddress_mobile").val(),
                };
                $.post(url, params, function(d) {
                    if (d.status) {
                        input.showTimes();
                    }
                    else{
                        alert(d.data.message);
                    }
                }, 'json');
                $(this).unbind('click');
            });
        },
        //显示短信发送状态信息
        'showTimes': function() {
            var input = this;
            var n = 5;
            var url = $(this).attr("url");
            iID = setInterval(function() {
                if (n <= 0) {
                    $(".sendBtn").val("发送短信验证码");
                    input.sendMobileBindSmsCode();
                    clearInterval(iID);
                } else {
                    $(".sendBtn").val("(" + (--n) + ")秒后再次发送");
                }
            }, 1000);
        },
    }
})();
