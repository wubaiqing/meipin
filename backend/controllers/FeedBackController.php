<?php

/**
 * 用户管理
 *
 * @author wubaiqing
 */
class FeedBackController extends Controller
{

    public function actionAdmin()
    {
        $model = new FeedBack();
        $model->unsetAttributes();
        if (isset($_GET['FeedBack'])) { 
            $model->attributes = Yii::app()->request->getQuery(CHtml::modelName($model));
            print_r( $model->attributes);
        }
        $this->render('feedback', [
            'model' => $model,
        ]);
    }
}
