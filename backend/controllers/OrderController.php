<?php

/**
 * 积分兑换
 *
 * @author zhangchao
 */
class OrderController extends Controller
{

    //判断是否登陆，没有登陆就返回登陆
    public function beforeAction($action)
    {
        if (!Yii::app()->user->id) {
            $this->redirect(array('site/login'));
        }

        return parent::beforeAction($action);
    }

    public function loadModel($id)
    {
        $id = intval($id);
        $order = Order::model()->findByPk($id);
        if (!$order) {
            throw new CHttpException('400', '查询记录失败');
        }

        return $order;
    }


    /**
     * 将订单改为已支付状态
     */
    public function actionChangePaystatus($order_id)
    {
        $order = Order::model()->findByPk($order_id);
        if($order->pay_status==1){
            //echo '已过期';
            $exchangeLog = ExchangeLog::model()->findByAttributes([
            'order_id' => $order_id
            ]);
           $exchangeLog->pay_status = 1;
           $exchangeLog->update(['pay_status']);
            UserLoginLog::addOperation("将({$order_id})改为了已支付状态");
            Order::model()->updateByPk($order_id, array('pay_status' => 4));
            echo "修改成功";
            die;
        }else
        {
            echo '只能将已过期的订单改为已支付';
            die;
        }
        //Order::model()->updateByPk($order_id, array('pay_status' => $is_first));
    }


    /**
     * 积分兑换列表
     */
    public function actionAdmin($id="")
    {
        $orderModel = new Order();
        $orderModel->unsetAttributes();
        if($id)
        {
            $orderModel->order_id = $id;
        }
        $orderModel->order_type = 1;
        if (isset($_GET[CHtml::modelName($orderModel)])) {
            $orderModel->attributes = Yii::app()->request->getQuery(CHtml::modelName($orderModel));
        }
        $this->render('admin', [
            'orderModel' => $orderModel,
            'titleLabel' => '积分兑换订单',
        ]);
    }

    /**
     * 积分兑换列表
     */
    public function actionRaffleAdmin()
    {
        $exchangeModel = new Exchange();
        $exchangeModel->unsetAttributes();
        $exchangeModel->goods_type = 1;

        $post = Yii::app()->request->getQuery(CHtml::modelName($exchangeModel));
        //是否是删除的
        if (empty($post) || isset($post['is_delete']) && $post['is_delete'] == "") {
            $exchangeModel->is_delete = 0;
        }
        if (isset($_GET[CHtml::modelName($exchangeModel)])) {
            $exchangeModel->attributes = $post ;
        }
        $this->render('admin', [
            'exchangeModel' => $exchangeModel,
            'titleLabel' => '抽奖商品管理',
        ]);
    }

    /**
     * 删除积分兑换
     * @param  type           $id
     * @throws CHttpException
     */
    public function actionDelete($id)
    {
        $eid = intval($id);
        if ($eid == 0) {
            throw new CHttpException(400, '访问失败');
        }
        $exchangeModel = $this->loadModel($eid);
        if ($exchangeModel->updateByPk($eid, ['is_delete' => 1]) > 0) {
            $this->returnData(true, ['message'=>'删除成功']);
        } else {
            $this->returnData(false, ['message'=>'删除失败']);
        }
    }

    /**
     * 兑换商品列表
     */
    public function actionShipAdmin()
    {
        $exchange = Yii::app()->request->getQuery("Exchange");
        $exchangeLog = Yii::app()->request->getQuery("ExchangeLog");
        $users = Yii::app()->request->getQuery("Users");

        $model = new ExchangeLog();
        $model->user_id ="<>''"; //查询用户id不为空
        //查询赋值
        if (!empty($exchange)) {
            $model->exchangeModel->attributes = $exchange;
        }
        if (!empty($exchangeLog)) {
            $model->attributes = $exchangeLog;
        }
        if (!empty($users)) {
            $model->userModel->attributes= $users;
        }
        //设置默认值
        if (empty($exchangeLog) || isset($exchangeLog['status']) && $exchangeLog['status'] == "") {
            $model->status = "";
        }
        //设置默认值
        if (empty($exchangeLog) || isset($exchangeLog['pay_status']) && $exchangeLog['pay_status'] == "") {
            $model->pay_status = 1;
        }
        //渲染模板
        $this->render('shipAdmin', [
            'model' => $model,
            'titleLabel' => '兑换发货管理',
            'data' => ['goods_type' => 0],
        ]);
    }

    /**
     * 兑换商品列表
     */
    public function actionRaffleShipAdmin($id=0)
    {
        $exchange = Yii::app()->request->getQuery("Exchange");
        $exchangeLog = Yii::app()->request->getQuery("ExchangeLog");
        $users = Yii::app()->request->getQuery("Users");

        $model = new ExchangeLog();
        $model->winner = 1;
        if($id!=0)
        {
            $model->goods_id = $id;
        }
        //$model->user_id ="<>''"; //查询不是注水用户的订单
        //查询赋值
        if (!empty($exchange)) {
            $model->exchangeModel->attributes = $exchange;
        }
        if (!empty($users)) {
            $model->userModel->attributes= $users;
        }
        if (!empty($exchangeLog)) {
            $model->attributes = $exchangeLog;
        }
        //设置默认值
        if (empty($exchangeLog) || isset($exchangeLog['status']) && $exchangeLog['status'] == "") {
            $model->status = "";
        }
                //设置默认值
        if (empty($exchangeLog) || isset($exchangeLog['pay_status']) && $exchangeLog['pay_status'] == "") {
            $model->pay_status = 1;
        }

        //设置默认值
        if (empty($exchangeLog) || isset($exchangeLog['user_id']) && ($exchangeLog['user_id'] == "" )) {
            $model->user_id ="<>''"; //查询不是注水用户的订单
        }

        //渲染模板
        $this->render('shipAdmin', [
            'model' => $model,
            'titleLabel' => '中奖发货管理 ',
            'data' => ['goods_type' => 1],
        ]);
    }

    /**
     * 用户兑换记录查看编辑
     */
    public function actionShipView($id = 1)
    {
        $criteria = new CDbCriteria();
        $criteria->compare('t.id', $id); //修改不能支持模糊查询
        $criteria->with = array('exchange', 'address');
        $model = ExchangeLog::model()->find($criteria);

        if (empty($model)) throw new  CHttpException(404, '您所浏览的页面不存在.');
        //获取城市、身份
        $province = City::getByParentId(0);
        $provinceId = City::getProvinceId($model->city_id);
        $model->province = $provinceId;
        $city = City::getCityList($provinceId);

        //渲染模板
        $this->render('shipUpdate', [
            'model' => $model,
            'province' => $province,
            'city' => $city,
        ]);
    }

    /**
     * 兑换发货信息修改
     */
    public function actionAjaxShipUpdate($id)
    {
        $formType = Yii::app()->request->getPost("formType", null);
        if (!in_array($formType, ['status', 'address'])) {
            $this->returnData(false, ['message' => '参数错误']);
        }
        $post = Yii::app()->request->getPost("ExchangeLog", []);
        if ($formType == 'address') {
            $bool = ExchangeLog::upateAddress($id, $post);
        } else {
            $post['delivery_time'] = time();
            $bool = ExchangeLog::updateStatus($id, $post);
        }
        if ($bool) {
            $this->returnData(true, ['message' => '操作成功']);
        } else {
            $this->returnData(false, ['message' => '操作失败']);
        }
    }

    public function actionWater($id)
    {
        $exchangeModel = $this->loadModel($id);
        $exchangeLog = new ExchangeLog();
        if (Yii::app()->request->isPostRequest) {
            $exchangeLog->attributes = Yii::app()->request->getPost("ExchangeLog");
            $exchangeLog->winner = 1;
            $exchangeLog->user_add = 1;
            $exchangeLog->pay_status = 1; //pay_status 
            if ($d = $exchangeLog->save()) {
                $userCount = ExchangeLog::getUserCount($id);
                Exchange::model()->updateByPk($id, ['user_count'=>$userCount]);
                Exchange::deleteCache($id);
                ExchangeLog::deleteExchangeLogListCache($exchangeLog->goods_id);
                $this->redirect($this->createUrl('exchange/water',["id" => $id]));
            }
        }
        //查询注水中奖用户
//        $waterList = ExchangeLog::findWatterList($id);
        $water = new ExchangeLog();
        $water->goods_id = $id;
        $this->render('water', [
            'exchangeModel' => $exchangeModel,
            'exchangeLog' => $exchangeLog,
            'water' => $water,
        ]);
    }

    public function actionWaterUpdate($id,$type,$status = null)
    {
        $trans = Yii::app()->db->beginTransaction();
        try {
            $log = ExchangeLog::model()->findByPk($id);
            if ($type == 'delete') {
                $log->delete();
            } elseif ($type == 'winner' && !is_null($status)) {
                $log->winner = $status;
                $log->update(['winner']);
            } else {
                $this->returnData(false, ['message' => '操作失败']);
            }
            //更新用户数
            $userCount = ExchangeLog::getUserCount($log->goods_id);
            Exchange::model()->updateByPk($log->goods_id, ['user_count'=>$userCount]);
            $trans->commit();

            Exchange::deleteCache($log->goods_id);
            ExchangeLog::deleteExchangeLogListCache($log->goods_id);
            $this->returnData(true, ['message' => '操作成功']);
        } catch (Exception $ex) {
            $trans->rollback();
            $this->returnData(false, ['message' => '操作失败
          ']);
        }
    }

}
