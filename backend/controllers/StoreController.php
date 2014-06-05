<?php

class StoreController extends Controller
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
        $model = new Store('search');
        $model->unsetAttributes();
        if(isset($_GET['Store']))
            $model->attributes = $_GET['Store'];

        $this->render('admin',array(
            'model' => $model,
        ));
    }

    public function actionCreate()
    {
        $model=new Store;

        if (isset($_POST['Store'])) {
            $model->attributes = $_POST['Store'];
            if ($model->save()) {
                User::deleteCache();
                $this->redirect(array('admin'));
            }
        }

        $this->render('create',array(
            'model' => $model,
        ));
    }

    public function actionUpdate($id)
    {
        $model = $this->loadModel($id);

        if (isset($_POST['Store'])) {
            $model->attributes = $_POST['Store'];
            if ($model->save()) {
                User::deleteCache();
                $this->redirect(array('admin'));
            }
        }

        $this->render('update',array(
            'model' => $model,
        ));
    }

    public function actionDelete($id)
    {
        $this->loadModel($id)->delete();

        if(!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
    }

    public function loadModel($id)
    {
        $model = Store::model()->findByPk($id);
        if($model === null)
            throw new CHttpException(404,'The requested page does not exist.');

        return $model;
    }
}
