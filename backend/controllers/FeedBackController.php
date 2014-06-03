<?php

/**
 * 用户反馈
 *
 * @author guoll
 */
class FeedBackController extends Controller
{

    public function actionAdmin()
    {
        $model = new FeedBack();
        $model->unsetAttributes();
        if (isset($_GET['FeedBack'])) {
            $model->attributes = Yii::app()->request->getQuery(CHtml::modelName($model));
        }
        $this->render('feedback', [
            'model' => $model,
        ]);
    }

    public function actionDelete($id)
    {
        /*if (FeedBack::model()->deleteByPk($id)) {
           $this->redirect(['admin']);
        }  */
        $post=FeedBack::model()->findByPk($id);
        $post->is_delete=1;
        if ($post->save()) {
            $this->redirect(['admin']);
        }

    }
}
