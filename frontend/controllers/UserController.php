<?php
/**
 * 用户管理
 * @author wubaiqing <wubaiqing@vip.qq.com>
 * @copyright Copyright (c) 2014 美品网
 * @since 1.0
 */
class UserController extends Controller
{
    /**
     * @var string $layout
     */
    public $layout = '//layouts/user';
    
    /**
     * 验证码
     */
    public function actions()
    {
        return [
            'captcha' => [
                'class' => 'CCaptchaAction',
                'backColor' => 0xFFFFFF,
                'maxLength' => 4,
                'minLength' => 4,
                'height' => 40,
                'width' => 120,
            ]
        ];
    }

    /**
     * 用户登陆
     */
    public function actionLogin()
    {
        if (!Yii::app()->user->isGuest) {
            $this->redirect(['site/index']);
            Yii::app()->end();
        }
        
        $model = new LoginForm();
        if (isset($_POST['LoginForm'])) {
            $model->attributes = $_POST['LoginForm'];
            if ($model->login()) {
                $this->renderIndex('yes', '登录成功');
                Yii::app()->end();
            }
        }
        
        $this->render('login', ['model' => $model]);
    }

    /**
     * 用户退出登录
     */
    public function actionLogout()
    {
        Yii::app()->user->logout();
        $this->renderIndex('yes', '安全退出');
    }

    /**
     * 用户注册
     */
    public function actionRegister()
    {
        $model = new User('register');
        if (isset($_POST['User'])) {
            $model->attributes = $_POST['User'];
            if ($model->save()) {
                $model = new LoginForm();
                $model->attributes = $_POST['User'];
                $model->login();
                $this->renderIndex('yes', '注册成功');
            }
        }
        $this->render('register', ['model' => $model]);
    }
    
    /**
     * 跳转首页
     */
    public function renderIndex($status, $message)
    {
        $this->render('loginSuccess', [
            'status' => $status, 
            'message' => $message, 
            'url' => $this->createAbsoluteUrl('site/index')
        ]);
        Yii::app()->end();
    }
}
