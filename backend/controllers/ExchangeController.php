<?php

/**
 * 积分兑换
 *
 * @author zhangchao
 */
class ExchangeController extends Controller
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
        $exchaneModel = Exchange::model()->findByPk($id);
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
        $list_order = $order;
        Exchange::model()->updateByPk($id, array('list_order' => $list_order));
    }

    /**
     * 修改积分商品是否显示在首页
     */
    public function actionChangeFirst($id)
    {
        $exchange = Exchange::model()->findByPk($id);
        $is_first = 1;
        if ($exchange->is_first == 1) {
            $is_first = 2;
        } else {
            $is_first = 1;
        }
        Exchange::model()->updateByPk($id, array('is_first' => $is_first));
    }
    /**
     * 添加积分兑换
     * @author zhangchao
     */
    public function actionAdd()
    {
        $exchangeModel = new Exchange();
        $exchangeModel->goods_type = 0;
        //去掉这几个字段的默认值
        $exchangeModel->unsetAttributes(['num', 'price', 'integral', 'start_time', 'end_time']);
        if (isset($_POST['Exchange'])) {
            $bigimg_url ="";
            $file = CUploadedFile::getInstance($exchangeModel,'bigimg_url');
            if(is_object($file) && get_class($file) === 'CUploadedFile')
            {   
                Yii::import('common.extensions.aliyunapi.OSSClient2');
                $OSSClient = new OSSClient2;
                // 域名
                $domain = "http://static.meipin.com/";
                // 图片信息
                $size = filesize($file->tempName);
                $content = fopen($file->tempName, 'r');
                $imagePath = date('Y/m/d/');
                $imageName = uniqid();
                $imageExtension = $file->name;

                // 上传图片地址
                $prefixPath = 'images/';
                $filePath = $prefixPath . $imagePath . uniqid()  . $imageExtension;

                // 上传图片
                $OSSClient->putResourceObject($filePath, $content, $size);
                //$exchangeModel ->bigimg_url = $domain . $filePath;
                $bigimg_url =  $domain . $filePath;
            } 
           
            $attributes = Yii::app()->request->getPost('Exchange');
            $attributes = Exchange::format($attributes);
            $isChange = Yii::app()->request->getPost("isChange");
            $exchangeModel->attributes = $attributes;
            $exchangeModel->goodscolor2 = $attributes['goodscolor'];
            $exchangeModel->bigimg_url = $bigimg_url;
            if ($isChange == 0 && $exchangeModel->save()) {
                User::deleteCache();
                $this->redirect($this->createUrl('exchange/Admin'));
            }
        }
        $this->render('create', [
            'exchangeModel' => $exchangeModel,
            'titleLabel' => '添加兑换商品',
        ]);
    }

    /**
     * 添加积分兑换
     * @author zhangchao
     */
    public function actionRaffleAdd()
    {
        $exchangeModel = new Exchange();
        $exchangeModel->goods_type = 1;
        //去掉这几个字段的默认值
        $exchangeModel->unsetAttributes(['num', 'price', 'integral', 'start_time', 'end_time']);
        if (isset($_POST['Exchange'])) {
            $attributes = Yii::app()->request->getPost('Exchange');
            $attributes = Exchange::format($attributes);
            $isChange = Yii::app()->request->getPost("isChange");
            $exchangeModel->attributes = $attributes;
            $exchangeModel->goodscolor2 = $attributes['goodscolor'];
            if ($isChange == 0 && $exchangeModel->save()) {
                User::deleteCache();
                if ($exchangeModel->goods_type == 0) {
                    $this->redirect($this->createUrl('exchange/admin'));
                } elseif ($exchangeModel->goods_type == 1) {
                    $this->redirect($this->createUrl('exchange/raffleAdmin'));
                }
            }
        }
        $this->render('create', [
            'exchangeModel' => $exchangeModel,
            'titleLabel' => '添加抽奖商品',
        ]);
    }

    /**
     * 编辑积分兑换
     */
    public function actionUpdate()
    {
        $id = Yii::app()->request->getQuery('id');
        $exchangeModel = $this->loadModel($id);
        $imgold = $exchangeModel->img_url;
        $bigimgold = $bigimg_url = $exchangeModel->bigimg_url;
        if (isset($_POST['Exchange'])) {
            //如果不等于原图并且是在 阿里云 上的则删除原图
            if ($imgold != $_POST['Exchange']['img_url']) {

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

            $file = CUploadedFile::getInstance($exchangeModel,'bigimg_url');
            if(is_object($file) && get_class($file) === 'CUploadedFile')
            {  
                //如果存在上传则，先删除之前的
                Yii::import('common.extensions.aliyunapi.OSSClient2');
                $OSSClient = new OSSClient2;
                $bigimg_url ="";
                $domain = strstr($bigimgold, 'aliyuncs.com');
                if ($domain) {
                    $picoldkey = strstr($domain, 'images/');
                    //阿里云接口
                    if ($picoldkey) {
                        $OSSClient->deleteObject($picoldkey);
                    }
                };
                // 域名
                $domain = "http://static.meipin.com/";
                // 图片信息
                $size = filesize($file->tempName);
                $content = fopen($file->tempName, 'r');
                $imagePath = date('Y/m/d/');
                $imageName = uniqid();
                $imageExtension = $file->name;

                // 上传图片地址
                $prefixPath = 'images/';
                $filePath = $prefixPath . $imagePath . uniqid()  . $imageExtension;

                // 上传图片
                $OSSClient->putResourceObject($filePath, $content, $size);
                //$exchangeModel ->bigimg_url = $domain . $filePath;
                $bigimg_url =  $domain . $filePath;

            }
            $attributes = Yii::app()->request->getPost('Exchange');
            $attributes = Exchange::format($attributes);
  //        var_dump($attributes['description']);die;
            $exchangeModel->attributes = $attributes;
            $exchangeModel->goodscolor2 = $attributes['goodscolor'];
            $exchangeModel->bigimg_url = $bigimg_url;
            if ($exchangeModel->save()) {
                User::deleteCache();
                if ($exchangeModel->goods_type == 0) {
                    $this->redirect($this->createUrl('exchange/admin'));
                } elseif ($exchangeModel->goods_type == 1) {
                    $this->redirect($this->createUrl('exchange/raffleAdmin'));
                }
            }
        }
        $this->render('update', [
            'exchangeModel' => $exchangeModel,
            'titleLabel' => $exchangeModel->goods_type == 0 ? "更新兑换商品" : "更新抽奖商品"
        ]);
    }

    /**
     * 积分兑换列表
     */
    public function actionAdmin()
    {
        $exchangeModel = new Exchange();
        $exchangeModel->unsetAttributes();
        $exchangeModel->goods_type = 0;
        if (isset($_GET[CHtml::modelName($exchangeModel)])) {
            $exchangeModel->attributes = Yii::app()->request->getQuery(CHtml::modelName($exchangeModel));
        }
        $this->render('admin', [
            'exchangeModel' => $exchangeModel,
            'titleLabel' => '兑换商品管理',
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

        $model = new ExchangeLog();
        $model->user_id ="<>''"; //查询用户id不为空
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
