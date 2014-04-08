<div class="box">

    <h3 class="box-header">这些值得买U站</h3>

    <form action='http://zxzdm.uz.taobao.com/getdata.php' method='post' target="_blank">
        <textarea style='display:none;' name='goodsIds' cols='100' rows=100><?php echo $delete; ?></textarea>
        <textarea style='display:none;' name='goodsData' cols='100' rows=100><?php echo $insert; ?></textarea>
        <textarea style='display:none;' name='linkIds' cols='100' rows=100><?php echo $linkDelete; ?></textarea>
        <textarea style='display:none;' name='LinkData' cols='100' rows=100><?php echo $linkInsert; ?></textarea>
        <input type='submit' class="btn btn-primary" value="自动更新U站数据"/>
        <a target="_blank" href="http://zxzdm.uz.taobao.com/view.php?hot=0&clearCache=1">清空"首页"缓存</a>
    </form>

</div>
