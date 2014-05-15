<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title><?php echo Yii::app()->params['title'];?></title>
        <meta name="keywords" content="<?php echo Yii::app()->params['keyword'];?>">
        <meta name="description" content="">
        <meta name="author" content="wubaiqing">
        <meta name="copyright" content="美品网">
        <link rel="stylesheet" type="text/css"  href="/assets/main.css?v=wubaiqing-1.0.1" />
        <link rel="stylesheet" type="text/css"  href="/assets/css/exchange.css?v=wubaiqing-1.0.2" />
        <script src="http://libs.baidu.com/jquery/2.0.0/jquery.min.js"></script>
        <script type="text/javascript" src="/assets/js/unslider.js?v=1.0.1"></script>
        <!-- 以下三个需要摘出，不能全局引用，否则error影响其他的js -->
        <script type="text/javascript" src="/assets/js/78df5a3f36d83192e43966bc05d643b2.js?v=1.0.1"></script>
        <script type="text/javascript" src="/assets/js/tuanpub3.0.min.js?v=1.0.1"></script>
        <script type="text/javascript" src="/assets/js/user.js?v=1.0.2"></script>


    </head>
    <body>
        <?php echo $content;?>
        <div style="display:none;">
            var cnzz_protocol = (("https:" == document.location.protocol) ? " https://" : " http://");document.write(unescape("%3Cspan style='display:none;' id='cnzz_stat_icon_1000359564'%3E%3C/span%3E%3Cscript src='" + cnzz_protocol + "s22.cnzz.com/z_stat.php%3Fid%3D1000359564%26show%3Dpic1' type='text/javascript'%3E%3C/script%3E"));
        </div>
    </body>
</html>
