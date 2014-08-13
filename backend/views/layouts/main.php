<?php /* @var $this Controller */ ?>
<!DOCTYPE HTML>
<html lang="zh">
    <head>
        <meta charset="utf-8">
        <title><?php echo Yii::app()->name; ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="<?php echo Yii::app()->request->baseUrl; ?>/styles/style.css" rel="stylesheet">
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/scripts/jquery-1.9.1.js"></script>
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/scripts/exchange/jquery.exchange.js"></script>
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/scripts/ckeditor/ckeditor.js"></script>
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/scripts/ckeditor/config.js"></script>
    </head>
    <body>
        <?php echo $content; ?>
    </body>
</html>
