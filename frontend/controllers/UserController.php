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
                ], parent::accessRules());
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
    public function actionLogin($referer = '')
    {
        if (!Yii::app()->user->isGuest) {
            $this->redirect(['site/index']);
            Yii::app()->end();
        }

        $this->layout = '//layouts/userBase';
        $model = new LoginForm();
        $post = Yii::app()->request->getPost('LoginForm');
        if (!empty($post)) {
            $model->attributes = $post;
            if ($model->login()) {
                $this->renderIndex('yes', '登录成功', $referer);
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

        $post = Yii::app()->request->getPost('User');
        if (!empty($post)) {
            $model->scenario = 'password';
            $model->oldModel = $oldModel;
            $model->attributes = $post;
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
        $this->layout = '//layouts/userBase';
        $model = new User('register');

        $post = Yii::app()->request->getPost('User');
        if (!empty($post)) {
            $model->attributes = $post;
            if ($model->save()) {
                $mailer = new PHPMailer();
                $mailer->isSMTP();
                $mailer->Host = 'smtp.126.com';
                $mailer->From = 'piaoxuedtian@126.com';
                $mailer->FromName = '美品网';
                $mailer->addAddress($model->email);
                $mailer->isHTML(true);
                $mailer->Subject = '这是我的测试邮件';
                $mailer->Body = '这是测试邮件的body';
                $mailer->AltBody = '这是altbody不知道干嘛用的';
                $mailer->SMTPAuth = true;
                $mailer->Username = 'piaoxuedtian@126.com';
                $mailer->Password = 'meipin123';
                if ($mailer->send()) {
                    echo 'success';
                    die;
                } else {
                    var_dump($mailer->ErrorInfo);
                    echo 'faile';
                    die;
                }

                $model = new LoginForm();
                $model->attributes = $_POST['User'];
                $model->login();
                $this->renderIndex('yes', '注册成功');
            }
            var_dump($model->getErrors());
            die;
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
        $province = City::getByParentId(0);
        $model->province = City::getProvinceId($model->city_id);
        $city = City::getCityList($model->province);
        $user = User::getUser($userId);
        $userAddress = Yii::app()->request->getPost('UsersAddress');
        if (!empty($userAddress)) {
            $post = UsersAddress::setAttr($userId, $userAddress);
            $model->attributes = $post;
            if ($model->save()) {
                //绑定用户手机信息
                if(!empty($model->code) && $user->mobile_bind == 0){
                    User::updateMobileBind($userId, $model->mobile, 1);
                }
                //删除地址缓存
                UsersAddress::deleteCacheByUserId($userId);
                //删除用户缓存
                User::deleteCache($userId);
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
     * 保存用户送货地址
     */
    public function actionAjaxUserAddressSave()
    {
        //校验是否登录
        if (!$this->isLogin) {
            $this->returnData(false, ['message' => '请先登录', 'isLogin' => $this->isLogin]);
        }
        //获取请求参数
        $userAddress = Yii::app()->request->getPost("UsersAddress");
        //保存数据
        $dataResult = ScoreService::saveUserAddress($this->userId, $userAddress);
        //返回json数据
        $this->returnData($dataResult['status'], ['message' => $dataResult['data']['message'], 'isLogin' => $this->isLogin]);
    }

    /**
     * 跳转首页
     */
    public function renderIndex($status, $message, $url = '')
    {
        if (empty($url)) {
            $url = $this->createAbsoluteUrl('user/login');
        }
        $this->layout = '//layouts/userBase';
        $this->render('loginSuccess', [
            'status' => $status,
            'message' => $message,
            'url' => $url
        ]);
        Yii::app()->end();
    }

    /**
     * 用户签到
     */
    public function actionDayRegistion()
    {
        if (empty($this->isLogin)) {
            $this->returnData(false, ['message' => "请先登录", 'isLogin' => $this->isLogin]);
        }
        $dataResult = ScoreService::updateScore($this->userId, "每日签到");
        $dataResult['data']['isLogin'] = $this->isLogin;
        $this->returnData($dataResult['status'], $dataResult['data']);
    }

    /**
     * 用户激活邮箱
     */
    public function actionActivateMail()
    {
        $email = Yii::app()->request->getQuery('email');
        $uid = Yii::app()->request->getQuery('secret');
    }

    /**
     * 手机绑定验证码发送
     */
    public function actionSendMobileBindSmsCode()
    {

        //
        $cacheKey = Sms::mobileValidateKey($this->userId);
        $code = Sms::mobileRandCode();
        Yii::app()->cache->set($cacheKey, $code);
        $this->returnData(true, ['message' => '发送成功','code'=>$code]);
    }

    /**
     * 手机绑定验证码绑定
     */
    public function actionMobileBind()
    {

        $this->returnData(true, ['message' => '验证成功']);
    }

}
