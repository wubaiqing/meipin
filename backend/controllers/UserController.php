<?php

/**
 * 用户管理
 *
 * @author wubaiqing
 */
class UserController extends Controller
{
    /**
     * 用户管理列表
     */
    public function actionAdmin()
    {
        $model = new Users();
        $model->unsetAttributes();
        if (isset($_GET['Users'])) {
            $model->attributes = Yii::app()->request->getQuery(CHtml::modelName($model));
        }
        $this->render('admin', [
            'model' => $model,
        ]);
    }
}
