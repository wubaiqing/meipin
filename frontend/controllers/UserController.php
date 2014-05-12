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
     * 访问权限
     */
    public function accessRules()
    {
        return array_merge([
            [
                'allow',
		'actions' => ['login', 'register'],
		'users' => ['*'],
            ],
	    [
		'deny',
		'actions' => ['index', 'password', 'logout', 'info', 'address'],
		'users' => ['?'],
	    ]
        ],parent::accessRules());
    }

    /**
     * 用户个人中心
     */
    public function actionIndex()
    {
        // 用户ID
        $userId = Yii::app()->user->id;

        // 获取用户积分记录
        $user = User::getUser($userId);
        $this->render('index', [
            'user' => $user
        ]);
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
        $this->layout = '//layouts/userBase';

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
     * 修改用户密码
     */
    public function actionPassword()
    {
        // 用户ID
        $userId = Yii::app()->user->id;
        $model = User::getUser($userId);
        $oldModel = clone $model;
        if (isset($_POST['User'])) {
            $model->scenario = 'password';
            $model->oldModel = $oldModel;
            $model->attributes = $_POST['User'];
            if ($model->save()) {
                User::deleteCache($userId);
                Yii::app()->user->logout();
                $this->renderIndex('yes', '密码修改成功');
            }
        }
        User::clearPassword($model);
        $this->render('password', ['model' => $model]);
    }

    /**
     * 用户信息
     */
    public function actionInfo()
    {
        // 用户ID
        $userId = Yii::app()->user->id;
        $model = User::getUser($userId);
        $this->render('info', ['model' => $model]);
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
     * 用户注册
     */
    public function actionAddress()
    {
        $userId = Yii::app()->user->id;
        $model = UsersAddress::getModel($userId);

        // 省份，城市
        $city = [];
        $province = City::getByParentId(0);
        $model->province = City::getProvinceId($model->city_id);
        if ($model->province > 0) {
            $city = City::getCityList($model->province);
        }

        if (isset($_POST['UsersAddress'])) {
            UsersAddress::setAttr($userId, $_POST['UsersAddress'],$model);
            if ($model->save()) {
                $this->renderIndex('yes', '用户地址修改成功');
            }
        }

        $this->render('address', [
            'model' => $model,
            'province' => $province,
            'city' => $city
        ]);
    }

    /**
     * 跳转首页
     */
    public function renderIndex($status, $message)
    {
        $this->layout = '//layouts/userBase';
        $this->render('loginSuccess', [
            'status' => $status,
            'message' => $message,
            'url' => $this->createAbsoluteUrl('site/index')
        ]);
        Yii::app()->end();
    }
}
