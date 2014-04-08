<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta charset="utf-8">
		<meta name="keywords" content="51促销网,51促销网独家优惠,51促销网官网,51促销网官方网站,zhe800,51促销网">
		<meta name="description" content="51促销网，每日搜罗全网最值得买的打折商品，汇集51促销网、九块邮、会员购等精品打折商品">
		<title><?php echo empty($this->pageTitle) ? '51促销网_折800网、九块邮、会员购等9.9包邮精选' : $this->pageTitle;?></title>
		<link rel="shortcut icon" href="http://www.40zhe.com/static/images/favicon.ico?v=wubaiqing1.5" type="image/x-icon">
		<link rel="stylesheet" type="text/css" href="http://www.40zhe.com/static/sale.css?v=wubaiqing1.7.1">
		<link rel="stylesheet" type="text/css" href="http://www.40zhe.com/static/sale_cuxiao.css?v=master">
		<script src="http://libs.baidu.com/jquery/1.9.0/jquery.min.js"></script>
		<script type="text/javascript" src="http://www.40zhe.com/static/jtzdm_lazyload.js?v=wubaiqing2.0"></script>
		<script type="text/javascript" src="http://www.40zhe.com/static/qwrap_leho.js?v=wubaiqing2.0"></script>

		<script src="http://l.tbcdn.cn/apps/top/x/sdk.js?appkey=21713190"></script>

		<script type="text/javascript">
			var broadcast_conf = {
				'goods': ['add', 'delete'],
				'like': ['add', 'remove'],
				'follow': ['add', 'remove']
			};
			QW.namespace('goods.utils');
			QW.namespace('goods.widgets');
			QW.namespace('goods.page');
			$(document).ready(function(){
				$(".slideshowlite").slideshow({
					pauseSeconds: 2,
					caption: false,
					width : 980
				});
			});
			$(document).ready(function (){
				$('#popClose').click(function (){
					$('#pop').hide();
				});
			});
    (function(win,doc){
        var s = doc.createElement("script"), h = doc.getElementsByTagName("head")[0];
        if (!win.alimamatk_show) {
            s.charset = 'gbk';
            s.async = true;
            s.src = "http://a.alimama.cn/tkapi.js";
            s.kslite = "";
            h.insertBefore(s, h.firstChild);
        }
        var o = {
            pid: "mm_10520376_5110986_15754279",
            unid:"",
            rd:1,
            appkey:"",
            monitor: function(msg){
                console.log(msg)
            },
            plugins: [
                //{name: 'keyword'},   /*内文关键字插件*/
                //{name: 'aroundbox'}  /*任意位置角标插件*/
            ]
        }
        win.alimamatk_onload = win.alimamatk_onload || [];
        win.alimamatk_onload.push(o);
    })(window,document);

		</script>
	</head>

	<body>
		<?php echo $content; ?>
		<div style="display:none;">
			<script src="http://s13.cnzz.com/stat.php?id=5786913&web_id=5786913" language="JavaScript"></script>
		</div>
		<script src="http://www.40zhe.com/static/common.js?v=wubaiqing1.5"></script>
		<script src="http://www.40zhe.com/static/common_40zhe.js?v=wubaiqing1.5"></script>
	</body>
</html>
