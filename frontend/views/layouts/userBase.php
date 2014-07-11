<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title><?php echo Yii::app()->params['title'];?></title>
        <meta name="keywords" content="<?php echo Yii::app()->params['keyword'];?>">
        <meta name="description" content="<?php echo Yii::app()->params['desc'];?>">
        <meta name="author" content="wubaiqing">
        <meta name="copyright" content="美品网">
        <meta property="qc:admins" content="257146000265510166375" />        
        <link rel="stylesheet" type="text/css"  href="/static/main.css?v=201404131000" />
        <link rel="stylesheet" type="text/css"  href="/static/user.css?v=201404131000" />
        <link rel="stylesheet" type="text/css"  href="/static/style.css?v=201404131000" />
		<link rel="stylesheet" type="text/css"  href="/static/nav_style_log.css?v=201404131000"/>
		<link rel="stylesheet" type="text/css"  href="/static/nav_style1.css?v=201404131000"/>
        <link rel = "Shortcut Icon" href="/static/images/favicon.ico">
        <script src="http://libs.baidu.com/jquery/1.9.0/jquery.js"></script>
        <script type="text/javascript" src="/static/js/user.js?v=1.0.2"></script>
        <script type="text/javascript" src="/static/js/sign_day.js?v=1.0.1"></script>
        <script type="text/javascript" src="/static/js/move.js?v=1.0.2"></script>
    </head>
    <body>
        <div id="header">
            <?php $this->renderPartial('//site/login'); ?>
            <?php $this->renderPartial('//site/head'); ?>
            <?php $this->renderPartial('//site/nav_person', ['cat' => 0]); ?>
        </div>
        <?php echo $content;?>
        <div id="footer" class="footer">
            <?php $this->renderPartial('//site/footer'); ?>
        </div>
    </body>
</html>
