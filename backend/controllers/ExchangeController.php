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
        if (isset($_POST['Exchange'])) {
            $exchangeModel->attributes = Yii::app()->request->getPost('Exchange');
            if ($exchangeModel->save()) {
                echo 'success';
                die;
            }
        }
        $this->render('create', array(
            'exchangeModel' => $exchangeModel,
        ));
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
                echo 'success';
                die;
            }
        }
        $this->render('_form', array(
            'exchangeModel' => $exchangeModel,
        ));
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
        $this->render('admin', array(
            'exchangeModel' => $exchangeModel,
        ));
    }

}
