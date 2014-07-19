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

    /**
     * 更新商品
     */
    public function actionUpdate()
    {
        $id = Yii::app()->request->getPost('goodsId');
        $goods = Goods::model()->findByPk($id);
        $goods->attributes = $_POST;
        $goods->status = 1;
        if (Yii::app()->user->id == null) {
            $this->returnData(5, '用户ID获取失败，请重新登录');
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
