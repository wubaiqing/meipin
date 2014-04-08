<div class="box">
    <h3 class="box-header">集分宝CSV</h3>

    <form class="form-search" method="post" action="">
        <div>
            <label>日期：</label>
            <input onfocus="WdatePicker({dateFmt:'yyyy-MM-dd', startDate:'%y-%M-%d 00:00:00', onpicking:function (dp) { $('#Goods_start_time').val(dp.cal.getNewDateStr()); dp.hide();}})" class="Wdate" name="Gold[start_time]" id="Goods_start_time" type="text">
            <input class="btn" value="下载" type="submit">
        </div>
    </form>

    <script type="text/javascript" src="/scripts/My97DatePicker/WdatePicker.js"></script>
</div>
