
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
        <link rel = "Shortcut Icon" href="/static/images/favicon.ico">
        <link rel="stylesheet" type="text/css"  href="/static/main.css?v=wubaiqing-1.0.2" />
        <link rel="stylesheet" type="text/css"  href="/static/css/common.css?v=wubaiqing-1.0.0" />
        <link rel="stylesheet" type="text/css"  href="/static/css/detail.css?v=wubaiqing-1.0.0" />
        <link rel="stylesheet" type="text/css"  href="/static/nav_style.css?v=wubaiqing-1.0.2"/>
        
        <script src="http://libs.baidu.com/jquery/1.10.2/jquery.min.js"></script>
        <script type="text/javascript" src="/static/js/unslider.min.js?v=1.0.1"></script>
        <script type="text/javascript" src="/static/js/jtzdm_lazyload.js?v=1.0.1"></script>
        <script type="text/javascript" src="/static/js/sign_day.js?v=1.0.1"></script>
        <script type="text/javascript" src="/static/js/user.js?v=1.0.2"></script>
        <script type="text/javascript" src="/static/js/exchange.js?v=1.0.2"></script>
        <script type="text/javascript" src="/static/js/move.js?v=1.0.2"></script>
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
    </body>
</html>
