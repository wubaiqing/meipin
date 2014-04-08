<?php

class SiteController extends Controller
{
    public $layout = '//layouts/main';

    public function accessRules()
    {
        return array(
            array('allow',
                'actions' => array('index', 'error', 'login', 'upload'),
                'users'=>array('*'),
            ),
            array('allow',
                'actions' => array('logout', 'clearCache'),
                'users' => array('@'),
            ),
            array('deny',
                'users'=>array('*'),
            ),
        );
    }

    public function actionIndex()
    {
        $this->redirect(array('site/login'));
    }

    public function actionUpload()
    {
        Yii::import('common.extensions.file.Upload');
        $domain = isset(Yii::app()->params['staticDomain']) ? Yii::app()->params['staticDomain'] : Yii::app()->baseUrl;
        $upload = new Upload('file');
        $upload->setOptions(array(
            'savePath' => 'static/images',
            'allowTypes' => array('image/jpeg', 'image/png'),
            'allowSize' => 1024 * 1024 * 5, // 5MB
        ));

        if ($upload->save()) {
            $data = array(
                'success' => true,
                'path' => $domain . $upload->fullPath,
            );
        } else {
            $data = array(
                'success' => false,
                'message' => $upload->getMesssage(),
            );
        }

        echo json_encode($data);
    }

    public function actionLogin()
    {
        if (!Yii::app()->user->isGuest) {
            $this->redirect(array('goods/admin'));
        }

        if (Yii::app()->request->isPostRequest && isset($_POST['name'], $_POST['password'])) {
            $identity = new UserIdentity($_POST['name'], $_POST['password']);
            if ($identity->authenticate()) {
                $duration = 86400;
                Yii::app()->user->login($identity, $duration);
                $this->redirect(array('goods/admin'));
            }
        }

        $this->render('login');
    }

    public function actionLogout()
    {
        Yii::app()->user->logout();
        $this->redirect(array('site/login'));
    }

    public function actionError()
    {
        if ($error = Yii::app()->errorHandler->error) {
            if(Yii::app()->request->isAjaxRequest)
                echo $error['message'];
            else
                $this->render('error', $error);
        }
    }

    public function actionClearCache()
    {
        $this->layout = '//layouts/column2';
        User::deleteCache();
        $this->render('prompt', array('prompt' => '缓存更新成功, 1秒后跳转..'));
    }
}
