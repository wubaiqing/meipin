<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title><?php echo Yii::app()->params['title'];?></title>
        <meta name="keywords" content="<?php echo Yii::app()->params['keyword'];?>">
        <meta name="description" content="">
        <meta name="author" content="wubaiqing">
        <meta name="copyright" content="美品网">
        <link rel="stylesheet" type="text/css"  href="/assets/main.css?v=201404131000" />
        <link rel="stylesheet" type="text/css"  href="/assets/user.css?v=201404131000" />
        <script src="http://libs.baidu.com/jquery/1.9.0/jquery.js"></script>
        <script type="text/javascript" src="/assets/js/user.js?v=1.0.1"></script>
    </head>
    <body>
        <div id="header">
            <?php $this->renderPartial('//site/login', array('cat' => 0)); ?>
            <?php $this->renderPartial('//site/head', array('cat' => 0)); ?>
            <?php $this->renderPartial('//site/nav', array('cat' => 0)); ?>
        </div>
        <?php echo $content;?>
        <div id="footer" class="footer">
            <?php $this->renderPartial('//site/footer'); ?>
        </div>
        <div style="display:none;">
            <script type="text/javascript">var cnzz_protocol = (("https:" == document.location.protocol) ? " https://" : " http://");document.write(unescape("%3Cspan id='cnzz_stat_icon_1000359564'%3E%3C/span%3E%3Cscript src='" + cnzz_protocol + "s22.cnzz.com/z_stat.php%3Fid%3D1000359564%26show%3Dpic1' type='text/javascript'%3E%3C/script%3E"));</script>
        </div>
    </body>
</html>
