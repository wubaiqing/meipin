<?php

/**
 * 积分兑换
 *
 * @author zhangchao
 */
class BrandController extends Controller
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
        $exchaneModel = Brand::model()->findByPk($id);
        if (!$exchaneModel) {
            throw new CHttpException('400', '查询记录失败');
        }

        return $exchaneModel;
    }

    /**
     * 修改积分排序
     */
    public function actionModifyOrder($order,$id)
    {
        $id = intval($id);
        $order = $order;
        Brand::model()->updateByPk($id, array('order' => $order));
    }

    /**
     * 修改品牌状态是否显示
     */
    public function actionChangeFirst($id)
    {
        $brand = Brand::model()->findByPk($id);
        $status = 0;
        if ($brand->status == 0) {
            $status = 1;
        } else {
            $status = 0;
        }
        Brand::model()->updateByPk($id, array('status' => $status));
    }
    /**
     * 添加品牌管理
     * @author zhangchao
     */
    public function actionAdd()
    {
        $brandModel = new Brand();
        if (isset($_POST['Brand'])) {
            $attributes = Yii::app()->request->getPost('Brand');
            $attributes = Brand::format($attributes);
            $isChange = Yii::app()->request->getPost("isChange");
            $brandModel->attributes = $attributes;
            $brandModel->start_time = $attributes['start_time'];
            $brandModel->end_time = $attributes['end_time'];
            if ($isChange == 0 && $brandModel->save()) {
                User::deleteCache();
                $this->redirect($this->createUrl('brand/admin'));
            }
        }
        $this->render('create', [
            'brandModel' => $brandModel,
            'titleLabel' => '添加品牌管理',
        ]);
    }

    /**
     * 编辑积分兑换
     */
    public function actionUpdate()
    {
        $id = Yii::app()->request->getQuery('id');
        $brandModel = $this->loadModel($id);
        $imgold = $brandModel->brand_img;
        if (isset($_POST['Brand'])) {
            //如果不等于原图并且是在 阿里云 上的则删除原图
            if ($imgold != $_POST['Brand']['brand_img']) {

                //http://wubaiqing.oss-cn-hangzhou.aliyuncs.com/images/2014/06/13/sfh9s1402642385539a9fd190b32.jpg
                $domain = strstr($imgold, 'aliyuncs.com');
                if ($domain) {
                    $picoldkey = strstr($domain, 'images/');
                    //阿里云接口
                    if ($picoldkey) {
                        Yii::import('common.extensions.aliyunapi.OSSClient2');
                        $OSSClient = new OSSClient2;
                        $OSSClient->deleteObject($picoldkey);
                    }
                }
            }
            $attributes = Yii::app()->request->getPost('Brand');
            $attributes = Brand::format($attributes);
            $brandModel->attributes = $attributes;
            if ($brandModel->save()) {
                User::deleteCache();
                $this->redirect($this->createUrl('brand/admin'));

            }
        }
        $this->render('update', [
            'brandModel' => $brandModel,
            'titleLabel' => "修改品牌"
        ]);
    }

    /**
     * 品牌管理列表
     */
    public function actionAdmin()
    {
        $brandModel = new Brand();
        $brandModel->unsetAttributes();
        if (isset($_GET[CHtml::modelName($brandModel)])) {
            $brandModel->attributes = Yii::app()->request->getQuery(CHtml::modelName($brandModel));
        }
        $this->render('admin', [
            'brandModel' => $brandModel,
            'titleLabel' => '品牌列表',
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
        if (isset($_GET[CHtml::modelName($exchangeModel)])) {
            $exchangeModel->attributes = Yii::app()->request->getQuery(CHtml::modelName($exchangeModel));
        }
        $this->render('admin', [
            'exchangeModel' => $exchangeModel,
            'titleLabel' => '抽奖商品管理',
        ]);
    }

    /**
     * 删除品牌管理
     * @param  type           $id
     * @throws CHttpException
     */
    public function actionDelete($id)
    {
        $eid = intval($id);
        if ($eid == 0) {
            throw new CHttpException(400, '访问失败');
        }
        $brandModel = $this->loadModel($eid);
        if ($brandModel->updateByPk($eid, ['is_delete' => 1]) > 0) {
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

        $model = new ExchangeLog();
        //查询赋值
        if (!empty($exchange)) {
            $model->exchangeModel->attributes = $exchange;
        }
        if (!empty($exchangeLog)) {
            $model->attributes = $exchangeLog;
        }
        //设置默认值
        if (empty($exchangeLog) || isset($exchangeLog['status']) && $exchangeLog['status'] == "") {
            $model->status = "";
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
    public function actionRaffleShipAdmin()
    {
        $exchange = Yii::app()->request->getQuery("Exchange");
        $exchangeLog = Yii::app()->request->getQuery("ExchangeLog");

        $model = new ExchangeLog();
        $model->winner = 1;
        //查询赋值
        if (!empty($exchange)) {
            $model->exchangeModel->attributes = $exchange;
        }
        if (!empty($exchangeLog)) {
            $model->attributes = $exchangeLog;
        }
        //设置默认值
        if (empty($exchangeLog) || isset($exchangeLog['status']) && $exchangeLog['status'] == "") {
            $model->status = "";
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
            if ($d = $exchangeLog->save()) {
                $userCount = ExchangeLog::getUserCount($id);
                Exchange::model()->updateByPk($id, ['user_count'=>$userCount]);
                Exchange::deleteCache($id);
                ExchangeLog::deleteExchangeLogListCache($exchangeLog->goods_id);
                $this->redirect($this->createUrl('exchange/Admin'));
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
