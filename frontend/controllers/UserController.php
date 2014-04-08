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
	 * 页面访问权限
	 * @return array 权限列表
	 */
	public function accessRules()
	{
		return array();
	}

	/**
	 * 用户注册
	 */
	public function actionRegister()
	{
		$model = new User;
		$model->scenario = 'register';
		if (isset($_POST['User'])) {
			$model->attributes = $_POST['User'];
			if ($model->save()) {
				echo '123';
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

