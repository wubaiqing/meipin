<?php
/**
 * 今天值得买用户中心
 * @author wubaiqing<wubaiqing@vip.qq.com>
 * @copyright Copyright (c) 2013 今天值得买
 * @since 1.5
 */
class UserController extends Controller
{
    /**
     * @var string $layout 继承视图
     */
	public $layout = '//layouts/user';

    /**
     * 验证码
     */
    public function actions()
    { 
        return array( 
            'captcha'=>array(
                'class'=>'CCaptchaAction',
                'backColor'=>0xFFFFFF, 
                'maxLength'=>'4',
                'minLength'=>'4',
                'height'=>'40',
                'width'=>'120',
            ), 
        ); 
    }

    public function actionLogin()
    {
		$model = new Users('register');
		var_dump($model);
		$code = Yii::app()->controller->createAction('captcha');
		var_dump($code);
		exit;
		$model = new LoginForm();
		$model->attributes = $_POST;
		var_dump($model->save());
        var_dump($_POST);
        exit;
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
                $this->redirect(array('user/login'));
			}
		}
		$this->render('register', array(
			'model' => $model
		));
	}

	/**
	 * 密码管理
	 */
	public function actionPasswordManager()
	{
		$userId = Yii::app()->user->id;
		$userId = '1';
		
		$model = User::model()->findByPk($userId);
		$model->scenario = 'passwordManager';
		if (isset($_POST)) {
			$post = $_POST['User'];
			$model->attributes = $post;
			if ($model->save()) {
			} else {
				var_dump($model->getErrors());
			}
		}
	}

	/**
	 * 用户签到
	 */
	public function actionUserSign()
	{
		$userId = Yii::app()->user->id;
		$userId = '1';
		User::userSign($userId);
	}

	/**
	 * 积分管理
	 */
	public function actionScoreManage()
	{

	}


	public function actionGetGold()
	{
		
	}
}

