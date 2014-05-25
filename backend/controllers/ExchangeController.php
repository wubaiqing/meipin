<?php

/**
 * 积分兑换
 *
 * @author zhangchao
 */
class ExchangeController extends Controller
{

    public function loadModel($id)
    {
        $id = intval($id);
        $exchaneModel = Exchange::model()->findByPk($id);
        if (!$exchaneModel) {
            throw new CHttpException('400', '查询记录失败');
        }

        return $exchaneModel;
    }

    /**
     * 添加积分兑换
     * @author zhangchao
     */
    public function actionAdd()
    {
        $exchangeModel = new Exchange();
        //去掉这几个字段的默认值
        $exchangeModel->unsetAttributes(['num', 'price', 'integral', 'start_time', 'end_time']);
        if (isset($_POST['Exchange'])) {
            $exchangeModel->attributes = Yii::app()->request->getPost('Exchange');
            if ($exchangeModel->save()) {
                $this->redirect($this->createUrl('exchange/Admin'));
            }
        }
        $this->render('create', [
            'exchangeModel' => $exchangeModel,
        ]);
    }

    /**
     * 编辑积分兑换
     */
    public function actionUpdate()
    {
        $id = Yii::app()->request->getQuery('id');
        $exchangeModel = $this->loadModel($id);
        if (isset($_POST['Exchange'])) {
            $exchangeModel->attributes = Yii::app()->request->getPost('Exchange');
            if ($exchangeModel->save()) {
                $this->redirect($this->createUrl('exchange/Admin'));
            }
        }
        $this->render('update', [
            'exchangeModel' => $exchangeModel,
        ]);
    }

    /**
     * 积分兑换列表
     */
    public function actionAdmin()
    {
        $exchangeModel = new Exchange();
        $exchangeModel->unsetAttributes();
        if (isset($_GET[CHtml::modelName($exchangeModel)])) {
            $exchangeModel->attributes = Yii::app()->request->getQuery(CHtml::modelName($exchangeModel));
        }
        $this->render('admin', [
            'exchangeModel' => $exchangeModel,
        ]);
    }

    /**
     * 删除积分兑换
     * @param type $id
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
            $this->redirect($this->createUrl('exchange/Admin'));
        } else {
            throw new CHttpException(400, '编辑失败');
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
        if(empty($exchangeLog) || isset($exchangeLog['status']) && $exchangeLog['status'] == "") {
            $model->status = "";
        }
        //渲染模板
        $this->render('shipAdmin', [
            'model' => $model,
        ]);
    }

    /**
     * 用户兑换记录查看编辑
     */
    public function actionShipView($id = 1)
    {
        $criteria = new CDbCriteria();
        $criteria->compare('t.id', $id, true);
        $criteria->with = array('exchange', 'address');
        $model = ExchangeLog::model()->find($criteria);
        
        if(empty($model))
            throw new CHttpException(404, '您所浏览的页面不存在.');
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

}
