var exchange = {};
/**
 * 更新发货状态
 * @param {type} status 当前操作对象
 * */
exchange.orderStatusChange = function(status) {
    var url = $("#status-form").attr("action");
    var params = $("#status-form").serialize();
    $.post(url, params, function(d) {
        if (d.status) {
            window.location.href = location.href;
        }
    });

}
$(function() {
    //配送详情页，用户配送信息修改
    $("#edit").click(function() {
        var input = this;
        if ($(this).val() == "编辑") {
            $(".exchange_detail").find("input,select,textarea").attr("disabled", false);
            $(this).val("保存")
        }
        else if ($(this).val() == "保存") {
            var url = $("#score-form").attr("action");
            var params = $("#score-form").serialize();

            $("#score").remove();
            $(input).after("<span id='score' style='color:red;'>请稍等...</span>");

            $.post(url, params, function(d) {
                $(".exchange_detail").find("input,select,textarea").attr("disabled", true);
                $(input).val("编辑")
                $("#score").remove();
                $(input).after("<span id='score' style='color:red;'>" + d.data.message + "</span>");
            });
        }
    });
    //详情页面配送状态修改
    $("#status_edit").click(function() {
        var input = this;
        var url = $("#status-form").attr("action");
        var params = $("#status-form").serialize();
        $(input).after("<span id='status' style='color:red;'>请稍等...</span>");
        exchange.orderStatusChange();
    });
    //列表页面，配送状态修改
    $(".exchange_list_status").click(function() {
alert(3);
    });

});
