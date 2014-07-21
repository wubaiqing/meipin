<?php
/**
 * 淘宝U站抓取商品管理
 * @author wubaiqing <wubaiqing@vip.qq.com>
 * @copyright Copyright (c) 2014 美品网
 * @since 1.0
 */

/**
 * U站列表
 *
 * 1. 折800淘宝U站
 * http://zhe800.uz.taobao.com/
 *
 * 2. 九块邮U站
 * http://jiukuaiyoucom.uz.taobao.com/
 *
 * 3. 卷皮折扣U站
 * http://juanpi.uz.taobao.com/
 *
 * 创建日期：2014-7-19
 *
 * @author wubaiqing <wubaiqing@55tuan.com>
 */
class FetchController extends Controller
{
    /**
     * 验证当前账户是否登陆
     * @param  object $action 动作
     * @return bool
     */
    public function beforeAction($action)
    {
       if (!Yii::app()->user->id) {
         $this->redirect(['site/login']);
       }

       return parent::beforeAction($action);
    }

	/**
	 * 淘宝U站抓取数据管理页
	 *
	 * 数据查询
	 * 1. 只查询当前抓取的数据
	 * 2. 分类ID根据当前已选择的分类
	 * 3. 只查询是机器抓取的数据
	 */
	public function actionAdmin()
    {
        // 分类ID
        $catId = Yii::app()->request->getQuery('cat_id', 1);
	    $taobaoId = trim(Yii::app()->request->getQuery('taobaoId', null));
	    $title = trim(Yii::app()->request->getQuery('title', null));

	    // 时间限制
        $startTime = strtotime(date('Y-m-d'));
        $endTime = strtotime('+1 day');

	    // 查询条件
	    if (!empty($taobaoId)) {
		    $condition = 't.start_time >=:start_time And t.start_time <=:end_time And cat_id=:cat_id And status=:status And user_id=:user_id And tb_id =:tb_id';
		    $params = [':start_time' => $startTime, ':end_time' => $endTime, ':cat_id' => $catId, ':status' => 2, ':user_id' => '888', ':tb_id' => $taobaoId];
	    } elseif (!empty($title)) {
		    $condition = 't.start_time >=:start_time And t.start_time <=:end_time And cat_id=:cat_id And status=:status And user_id=:user_id And title LIKE :title';
		    $params = [':start_time' => $startTime, ':end_time' => $endTime, ':cat_id' => $catId, ':status' => 2, ':user_id' => '888', ':title' => "%{$title}%"];
		}else {
		    $condition = 't.start_time >=:start_time And t.start_time <=:end_time And cat_id=:cat_id And status=:status And user_id=:user_id';
		    $params = [':start_time' => $startTime, ':end_time' => $endTime, ':cat_id' => $catId, ':status' => 2, ':user_id' => '888'];
	    }
	    $goods = Goods::model()->findAll([
		    'condition' => $condition,
		    'params' => $params
	    ]);

        $this->render('admin', [
            'model' => $goods,
            'catId' => $catId,
	        'taobaoId' => $taobaoId,
	        'title' => $title
        ]);
    }

    /**
     * 更新U站商品
     *
     * 1. 加的商品，记录当前编辑账号
     * 2. 更新商品状态为显示状态
     */
    public function actionUpdate()
    {
        $id = Yii::app()->request->getPost('goodsId');

        $goods = Goods::model()->findByPk($id);
        $goods->attributes = $_POST;
        $goods->status = 1;
	    $goods->start_time = date('Y-m-d H:i:s', $goods->start_time);
	    $goods->end_time = date('Y-m-d H:i:s', $goods->end_time);
        if (Yii::app()->user->id == null) {
            $this->returnData(5, '用户已退出，请重新登录！');
        }
        $goods->user_id = User::getUserName(Yii::app()->user->id);
        if ($goods->save()) {
            $this->returnData(1, '保存成功');
        } else {
            var_dump($goods->getErrors());
            $this->returnData(4, '保存失败, 联系开发人员!');
        }
    }

}
