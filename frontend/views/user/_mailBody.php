<html>
    <head>
        <title><?php echo '美品网注册激活邮件';?></title>
    </head>
<body>
        <p>感谢你注册美品网,您的用户名是：<?php echo $userModel->username;?>:</p>
        <p>请点击以下注册确认链接，激活你的账号：<a href="<?php echo Yii::app()->request->hostInfo.$this->createUrl('user/ActivateMail',['email'=>$userModel->email,
                'usecret'=>Des::encrypt($userModel->id)]); ?>"><?php echo Yii::app()->request->hostInfo.$this->createUrl('user/ActivateMail',['email'=>$userModel->email,
            'usecret'=>Des::encrypt($userModel->id)]);?></a></p>
        <p>（如果你无法点击此链接，可以将链接地址复制到浏览器地址栏打开）</p>
        <p>这是一封系统自动发出的邮件，请不要直接回复。</p>
        <P>美品网（www.meipin.com）感谢您的支持</P>

</body>
</html>