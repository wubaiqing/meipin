var User = {};
User.Config = {
    'version': 1.0
};
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
                //弹出层方式发送验证码

//                //向弹出层赋值
//                var mobile = $("#UsersAddress_mobile").val();
//                $(".codeShowMobile").html(mobile);
//                $(".codeHiddenMobile").val(mobile);
//                //输出弹出层内容
//                var str = "<form id='sms-form' class='valid_code'>"
//                        + $("#sendSmsCode").html()
//                        + "</form>";
//                $.blockUI({
//                    message: str,
//                    css: {
//                        border: 'none',
//                        padding: '1px',
//                        opacity: 1,
//                        color: '#000',
//                        height: '180px',
//                        border: '1px solid #ccc',
//                                'font-size': '16px'
//                    }});
//                //给内容按钮绑定事件
//                $(".codeCancle").on('click', function() {
//                    $.unblockUI();
//                });
//                $(".codeOk").on('click', function() {
//                    var code = $("#sms-form").find("input[name='UsersAddress[code]']").val();
//                    var url = $("#sendSmsCode").attr("ajax-url");
//                    var params = $("#sms-form").serialize();
//                    $.post(url, params, function(d) {
//                        if (d.status) {
//                            $.unblockUI();
//                            $(".sendBtn").after("<span style='color:green;'>电话绑定成功</span>").remove();
//                        }
//                    }, 'json');
//                })

                //发送短信验证码
                var url = $(this).attr("url");
                var params = {
                    'UsersAddress[mobile]': $("#UsersAddress_mobile").val(),
                };
                $.post(url, params, function(d) {
                    if (d.status) {
                        input.showTimes();
                    }
                }, 'json');
            });
        },
        //显示短信发送状态信息
        'showTimes': function() {
            var input = this;
            var n = 5;
            var url = $(this).attr("url");
            var iID = setInterval(function() {
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
