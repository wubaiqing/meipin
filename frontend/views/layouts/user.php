<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title><?php echo Yii::app()->params['title'];?></title>
        <meta name="keywords" content="<?php echo Yii::app()->params['keyword'];?>">
        <meta name="description" content="<?php echo Yii::app()->params['desc'];?>">
        <meta name="author" content="wubaiqing">
        <meta property="qc:admins" content="257146000265510166375" />
        <meta name="copyright" content="美品网">
        <link rel="stylesheet" type="text/css"  href="/static/main.css?v=201404131000" />
        <link rel="stylesheet" type="text/css"  href="/static/user.css?v=201404131000" />
        <link rel = "Shortcut Icon" href="/static/images/favicon.ico">
        <script src="http://libs.baidu.com/jquery/1.9.0/jquery.js"></script>
        <link rel="stylesheet" type="text/css"  href="/static/nav_style.css"/>
        <script type="text/javascript" src="/static/js/user.js?v=1.0.2"></script>
        <script type="text/javascript" src="/static/js/sign_day.js?v=1.0.1"></script>
        <script type="text/javascript" src="/static/js/move.js?v=1.0.2"></script>
        <script type="text/javascript" src="http://malsup.github.io/min/jquery.blockUI.min.js"></script>
    </head>
    <body>
        <div id="header">
            <?php $this->renderPartial('//site/login'); ?>
            <?php $this->renderPartial('//site/head'); ?>
            <?php $this->renderPartial('//site/nav_person', ['cat' => 0]); ?>
        </div>
        <div id="content" class="wp">
            <?php $this->renderPartial('//user/left'); ?>
            <div class="user_r r">
                <?php echo $content;?>
            </div>
            <span class="clear"></span>
        </div>
        <div id="footer" class="footer">
            <?php $this->renderPartial('//site/footer'); ?>
        </div>
    </body>
</html>
