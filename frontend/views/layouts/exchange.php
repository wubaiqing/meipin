
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title><?php echo Yii::app()->params['title']; ?></title>
        <meta name="keywords" content="<?php echo Yii::app()->params['keyword']; ?>">
        <meta name="description" content="<?php echo Yii::app()->params['desc']; ?>">
        <meta name="author" content="wubaiqing">
        <meta property="qc:admins" content="257146000265510166375" />
        <meta name="copyright" content="美品网">
        <link rel="stylesheet" type="text/css"  href="/static/main.css?v=wubaiqing-1.0.2" />
        <link rel="stylesheet" type="text/css"  href="/static/css/exchange.css?v=wubaiqing-1.0.2" />
        <link rel="stylesheet" type="text/css"  href="/static/nav_style.css?v=wubaiqing-1.0.2"/>
        <link rel="stylesheet" type="text/css"  href="/static/layer/skin/layer.css?v=1.0.0"/>
        <link rel="stylesheet" type="text/css"  href="/static/layer/skin/layer.ext.css?v=1.0.0"/>
        <script src="http://libs.baidu.com/jquery/1.10.2/jquery.min.js"></script>
        <script type="text/javascript" src="/static/js/unslider.min.js?v=1.0.1"></script>
        <script type="text/javascript" src="/static/js/jtzdm_lazyload.js?v=1.0.1"></script>
        <script type="text/javascript" src="/static/js/sign_day.js?v=1.0.1"></script>
        <script type="text/javascript" src="/static/js/user.js?v=1.0.2"></script>
        <script type="text/javascript" src="/static/js/exchange.js?v=1.0.2"></script>
        <script type="text/javascript" src="/static/js/move.js?v=1.0.2"></script>
        <script type="text/javascript" src="/static/layer/lib.js?v=1.0.0"></script>
        <script type="text/javascript" src="/static/layer/layer.min.js?v=1.0.0"></script>
        <script>
            layer.use('extend/layer.ext.js'); //载入layer拓展模块
        </script>
        <!--[if IE 6]> 
        <script type="text/javascript" src="http://sentsin.com/lily/lib/png.js"></script>
        <script type="text/javascript">DD_belatedPNG.fix('.ie6PNG');</script>
        <![endif]-->
    </head>
    <body>
        <div id="header">
            <?php $this->renderPartial('//site/login'); ?>
            <?php $this->renderPartial('//site/head'); ?>
            <?php $this->renderPartial('//site/nav_person', ['cat' => 0]); ?>
        </div>
        <?php echo $content; ?>
        <div id="footer" class="footer">
            <?php $this->renderPartial('//site/footer'); ?>
        </div>
        <div style="display:none;">
            var cnzz_protocol = (("https:" == document.location.protocol) ? " https://" : " http://");document.write(unescape("%3Cspan style='display:none;' id='cnzz_stat_icon_1000359564'%3E%3C/span%3E%3Cscript src='" + cnzz_protocol + "s22.cnzz.com/z_stat.php%3Fid%3D1000359564%26show%3Dpic1' type='text/javascript'%3E%3C/script%3E"));
        </div>
        <div id="pay_confirm" style="display: none;">
            <div class="order_confirm">
                <div><h2>请在新打开的页面完成支付</h2></div>
                <div class="content">
                    <div>点击“已完成支付”，您可以直接查看订单</div>
                    <div>点击“支付失败”，您可以继续支付</div>
                </div>
                <div class="button">
                    <a class="btn_pay_ok" href="<?php echo Yii::app()->createUrl("order/list")?>">已完成支付</a>
                    <a class="btn_pay_no" href="javascript:void(0);">支付失败</a>
                </div>
            </div>
        </div>
    </body>
</html>
