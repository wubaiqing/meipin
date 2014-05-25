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
                //查出用户的信息
                $userModel = User::model()->findByPk(Yii::app()->user->getState('id'));
                //如果用户邮箱未激活，提示用户
                if ($userModel->is_valid == 0) {
                    $this->renderIndex('yes', '登录成功,但您的邮箱未激活，请先去激活邮箱',$referer);
                }
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
                //刚注册的用户信息写入缓存
                User::getUser($model->id);
                $body = $this->renderPartial('_mailBody',['userModel'=>$model],true);
                $subject = '美品网邮箱注册激活邮件';

                $mail = new MailService();
                if (!$mail->sendMail($body,$subject,$model->email)) {
                        throw new CHttpException(400,'邮件发送失败，请联系客服人员');
                }
                $this->renderIndex('yes', '注册成功！激活邮件已经发出，请先激活邮箱。');
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
                if (!empty($model->code) && $user->mobile_bind == 0) {
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
        $this->returnData($dataResult['status'], ['message' => $dataResult['data']['message'],
            'errors' => $dataResult['data']['errors'], 'isLogin' => $this->isLogin]);
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
        $uid = Yii::app()->request->getQuery('usecret');
        if (!$email || !$uid) {
            //此处需要改，增加一个友好的提示页面
            throw new CHttpException(400,'非法请求');
        }
        $uid = Des::decrypt($uid);//解密ID
        //获取用户的缓存
        $userModel = User::getUser($uid);
        if($userModel === null){
            $this->renderIndex('yes','您激活的邮箱不存在');
        }
        if($userModel->is_valid == 1){
            $this->renderIndex('yes','您的邮箱已经激活过了');
        }
        $userModel->is_valid = 1;//设置为已激活
        if($userModel->save()){
            //激活完成删除用户缓存
            User::deleteCache($userModel->id);
            $this->renderIndex('yes','激活成功');
        }
    }

    /**
     * 手机绑定验证码发送
     */
    public function actionSendMobileBindSmsCode()
    {
        $now = time();
        $post = Yii::app()->request->getPost("UsersAddress", null);
        if (empty($post) || !isset($post['mobile']) || !preg_match("/^\d+$/", $post['mobile'])) {
            $this->returnData(false, ['message' => '手机号码格式错误']);
        }
        //获取短信配置
        $smsDayMax = Yii::app()->params['sms'];
        //缓存KEY
        $cacheKey = Sms::mobileValidateKey($this->userId);
        //获取验证码
        $code = Sms::mobileRandCode();

        $user = User::model()->findByPk($this->userId);
        $today = strtotime(date("Y-m-d"));
        $last_sms_time = strtotime(date("Y-m-d", $user->last_sms_time));
        //验证短信发送信息
        if ($last_sms_time == $today && $user->sms_day_count >= $smsDayMax['sms_day_max']) {
            $this->returnData(false, ['message' => '今天短信发送数量超过最大限制，请明天再试']);
        }
        if ($last_sms_time == $today) {
            $user->sms_day_count = new CDbExpression('sms_day_count+1');
        } else {
            $user->sms_day_count = 1;
        }
        $user->last_sms_time = $now;
        //更新数据
        $user->update(['sms_day_count', 'last_sms_time']);

        Sms::send($post['mobile'], Sms::mobileValidateTpl($code));
        //日志
        AuthCodeLog::log($this->userId, "手机绑定验证码【".$code."】");
        Yii::app()->cache->set($cacheKey, $code);
        $this->returnData(true, ['message' => '发送成功']);
    }

    /**
     * 手机绑定验证码绑定
     */
    public function actionMobileBind()
    {

        $this->returnData(true, ['message' => '验证成功']);
    }

}
