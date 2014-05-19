var exchange = {};
/**
 * 更新发货状态
 * @param {type} status 当前操作对象
 * */
exchange.orderStatusChange = function(url, status) {
    $.post(url, {'ExchangeLog[status]': status, 'formType': 'status'}, function(d) {
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
    $("#ExchangeLog_status").change(function() {
        $("#status").remove();
    });
    //详情页面配送状态修改
    $("#status_edit").click(function() {
        var url = $("#status-form").attr("action");
        var status = $("#ExchangeLog_status").val();
        var oldStatus = $("#ExchangeLog_status").attr("status");
        $("#status").remove();
        if (oldStatus == status ||
                oldStatus == 1 && oldStatus != status && !confirm("当前状态为【已发货】，您确认要修改为【未发货】？")) {
            $(this).after("<span id='status' style='color:red;'>发货状态没有改变</span>");
            $("#ExchangeLog_status").attr("value",oldStatus);
            return false;
        }
        $(this).after("<span id='status' style='color:red;'>请稍等...</span>");
        exchange.orderStatusChange(url, status);
    });
    //列表页面，配送状态修改
    $(".exchange_list_status").click(function() {
        var url = $(this).attr("url");
        var status = $(this).attr("status");
        if (status == 1 && !confirm("当前状态为【已发货】，您确认要修改为【未发货】？")) {
            return false;
        }
        exchange.orderStatusChange(url, status == 0 ? 1 : 0);
    });

});
