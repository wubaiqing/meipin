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
        $exchangeModel->unsetAttributes();
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
                $this->redirect($this->createUrl('exchange/Admin'));
            }
        }
	$this->render('update', array(
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
    
    
    /**
     * 删除积分兑换
     * @param type $id
     * @throws CHttpException
     */
    public function actionDelete($id) {
        $eid = intval($id);
        if($eid == 0){
            throw new CHttpException(400,'访问失败');
        }
        $exchangeModel = $this->loadModel($eid);
        if($exchangeModel->updateByPk($eid, array('is_delete'=>1)) > 0){
            $this->redirect($this->createUrl('exchange/Admin'));
        }else{
            throw new CHttpException(400,'编辑失败');
        }
        
    }

}
