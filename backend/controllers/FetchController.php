<?php
/**
 * 抓取商品管理
 *
 * @author wubaiqing<wubaiqing@vip.qq.com>
 * @copyright Copyright (c) 2013 吴佰清
 * @since 1.4
 */
class FetchController extends Controller
{
	/**
	 * 验证权限
	 * @param object $action 动作
	 * @return bool
	 */
	public function beforeAction($action)
    {
       if (!Yii::app()->user->id) {
         $this->redirect(['site/login']);
       }
       return parent::beforeAction($action);
    }

	public function actionAdmin()
	{
		// 分类ID
		$catId = Yii::app()->request->getQuery('cat_id', 1);

		$startTime = strtotime(date('Y-m-d'));
		$endTime = strtotime('+1 day');
		$goods = Goods::model()->findAll([
			'condition' => 't.start_time >=:start_time And t.start_time <=:end_time And cat_id=:cat_id And status=:status And user_id=:user_id',
			'params' => array(':start_time' => $startTime, ':end_time' => $endTime, ':cat_id' => $catId, ':status' => 2, ':user_id' => '888')
		]);

		$this->render('admin', [
			'model' => $goods,
			'catId' => $catId,
		]);
	}

	public function actionUpdate()
	{
		// 分类ID
		$catId = Yii::app()->request->getQuery('cat_id', 1);

		$startTime = strtotime(date('Y-m-d'));
		$endTime = strtotime('+1 day');
		$goods = Goods::model()->findAll([
			'condition' => 't.start_time >=:start_time And t.start_time <=:end_time And cat_id=:cat_id And status=:status And user_id=:user_id',
			'params' => array(':start_time' => $startTime, ':end_time' => $endTime, ':cat_id' => $catId, ':status' => 2, ':user_id' => '888')
		]);

		$this->render('admin', [
			'model' => $goods,
			'catId' => $catId,
		]);
	}

}
