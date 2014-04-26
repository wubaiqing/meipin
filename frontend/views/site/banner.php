<script language='javascript'>		$(function () {			$shortcuts = get_cookie('shortcuts');			if ($shortcuts != "no") {				$("#shortcuts").show();			}		}		);		function close_shortcut() {			add_cookie("shortcuts", "no", 24 * 7);		}	</script>    <style>	.newuserbanner1,.newuserbanner2{background:#fff4dc;height:460px;margin-top:-5px;margin-bottom:20px;overflow: hidden; width: 100%}.newuserbanner2{height:140px;background: url(http://www.meipin.com/assets/images/1.png) top center #fff4dc no-repeat}.newuserbanner2 a{display: block;width:980px;height: 100%;margin: 0 auto}.fi07_1{position:relative;width:980px;height:100%;margin:0 auto;overflow:hidden}.fi07_1 span.close{position: absolute;top:18px;right:2px;width:40px;height:42px}.fi07_1 span.close a{width:40px;height:42px;background: url(http://www.vip800.com/data/static/images/icon6.png) 0 -320px no-repeat;display: block;}.fi07_1 span.close a:hover{background-position: 0 -362px}.fi07_1 ul{position:relative;overflow:hidden;height:460px}.fi07_1 ul li{width:980px;height:460px;float:left}.fi07_1 ul li img{width:980px;height:460px; vertical-align: top}.fi07_1 .fi_tab{position:absolute;bottom:25px;left:0;width:100%}.fi07_1 .fi_tab{cursor:default;height:16px;text-align:center}.fi07_1 .fi_tab span{cursor:pointer;display:inline-block;margin:0 6px;width:16px;height:16px;background:url(http://www.vip800.com/data/static/images/icon6.png) no-repeat -24px -404px}.fi07_1 .fi_tab span.now{background-position:0 -404px}.fi07_1 .fi_btn{cursor:pointer;display:inline-block;float:none;width:40px;height:79px;vertical-align:middle;overflow:hidden;position: absolute;top:220px}.fi07_1 .fi_btn a{width:40px;height:79px;display:block;background:url(http://www.vip800.com/data/static/images/icon6.png) no-repeat}.fi07_1 .l{left:50px}.fi07_1 .r{right:50px}.fi07_1 .l a{background-position:0 0}.fi07_1 .l a:hover{background-position:0 -79px}.fi07_1 .r a{background-position:0 -162px}.fi07_1 .r a:hover{background-position:0 -241px}	</style>
<div class="newuserbanner1" id="shortcuts" style="">
    <div class="fi07_1">
        <ul style="width: 3920px;">
            <li class="current" data-id="0"><img src="http://www.meipin.com/assets/images/1.png"></li>
            <li data-id="1"><img src="http://www.meipin.com/assets/images/2.png"></li>
            <li data-id="2"><img src="http://www.meipin.com/assets/images/3.png"></li>
            <li data-id="3"><img src="http://www.meipin.com/assets/images/4.png"></li>
        </ul>
        <em style="display: none;" data-id="0" class="fi_btn l"><a href="javascript:void(0);"></a></em><em data-id="1" class="fi_btn r"><a href="javascript:void(0);"></a></em><span class="close"><a href="javascript:void(0);" onclick="close_shortcut();"></a></span>
        <div class="fi_tab">
            <span data-id="0" class="now"></span><span data-id="1" class=""></span><span data-id="2" class=""></span><span data-id="3" class=""></span>
        </div>
    </div>
</div>
<div class="newuserbanner2" style="display: none;">    <a href="javascript:void(0);"></a> </div>
<script type="text/javascript">tuan800ued.getModule('banner_slide_show').init();</script>
