<?php

class CategoryController extends Controller
{


    //判断是否登陆，没有登陆就返回登陆 
    public function beforeAction($action)
    {
       if(!Yii::app()->user->id)
       {
         $this->redirect(array('site/login'));
       }  
       return parent::beforeAction($action);
    } 
    
    public function actionAdmin()
    {
        $model = new Cat('search');
        $model->unsetAttributes();
        if(isset($_GET['Cat']))
            $model->attributes = $_GET['Cat'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    public function actionCreate()
    {
        $model = new Cat;

        if (isset($_POST['Cat'])) {
            $model->attributes = $_POST['Cat'];
            if ($model->save()) {
                User::deleteCache();
                $this->redirect(array('admin', 'id' => $model->id));
            }
        }

        $this->render('create', array(
            'model' => $model,
        ));
    }

    public function actionUpdate($id)
    {
        $model = $this->loadModel($id);

        if (isset($_POST['Cat'])) {
            $model->attributes = $_POST['Cat'];
            if ($model->save()) {
                User::deleteCache();
                $this->redirect(array('admin', 'id' => $model->id));
            }
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    public function loadModel($id)
    {
        $model = Cat::model()->findByPk($id);
        if($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');

        return $model;
    }

    public function actionDelete($id)
    {
        $this->loadModel($id)->delete();

        if(!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }
}
