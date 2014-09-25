<?php

/**
 * 积分兑换
 *
 * @author zhangchao
 */
class ShaiController extends Controller
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
        $shaiModel = Shai::model()->findByPk($id);
        if (!$shaiModel) {
            throw new CHttpException('400', '查询记录失败');
        }

        return $shaiModel;
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
    public function actionAdd($id="")
    {
        $shaiModel = new Shai();
        if($id)
        {
            $shaiModel->goods_id = $id;
        }
        if (isset($_POST['Shai'])) {
            $attributes = Yii::app()->request->getPost('Shai');
            $attributes = Shai::format($attributes);
            $shaiModel->attributes = $attributes;
            if ( $shaiModel->save()) {
                User::deleteCache();
                $this->redirect($this->createUrl('Shai/admin'));
            }
        }
        $this->render('create', [
            'shaiModel' => $shaiModel,
            'titleLabel' => '添加晒单',
        ]);
    }

    /**
     * 编辑晒单
     */
    public function actionUpdate()
    {
        $id = Yii::app()->request->getQuery('id');
        $shaiModel = $this->loadModel($id);
        if (isset($_POST['Shai'])) {
            $attributes = Yii::app()->request->getPost('Shai');
            $shaiModel->attributes = $attributes;
            if ($shaiModel->save()) {
                User::deleteCache();
                $this->redirect($this->createUrl('shai/admin'));

            }
        }
        $this->render('update', [
            'shaiModel' => $shaiModel,
            'titleLabel' => "修改晒单"
        ]);
    }

    /**
     * 晒单管理列表
     */
    public function actionAdmin()
    {
        $shaiModel = new Shai();
        $shaiModel->unsetAttributes();
        if (isset($_GET[CHtml::modelName($shaiModel)])) {
            $shaiModel->attributes = Yii::app()->request->getQuery(CHtml::modelName($shaiModel));
            if($_GET['Shai']['goods_id'])
            {
                $shaiModel->goods_id = Des::decrypt($_GET['Shai']['goods_id']);
            }
        }
        $this->render('admin', [
            'shaiModel' => $shaiModel,
            'titleLabel' => '晒单列表',
        ]);
    }


    /**
     * 删除晒单
     * @param  type           $id
     * @throws CHttpException
     */
    public function actionDelete($id)
    {
        $eid = intval($id);
        if ($eid == 0) {
            throw new CHttpException(400, '访问失败');
        }
        $shaiModel = $this->loadModel($eid);
        if ($shaiModel->updateByPk($eid, ['is_delete' => 1]) > 0) {
            $this->returnData(true, ['message'=>'删除成功']);
        } else {
            $this->returnData(false, ['message'=>'删除失败']);
        }
    }

    
}

   
