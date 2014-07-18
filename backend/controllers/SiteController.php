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
        if(isset($_FILES['file'])){//普通上传
            $file = new Upload('file');
            $imageUrl = $file->uploadOSSImage($file);
            echo CJSON::encode([
                    'success' => 1,
                    'path' => $imageUrl
            ]);
        }elseif($_FILES['upload']){//富文本编辑器
            $file = new Upload('upload');
            $imageUrl = $file->uploadOSSImage($file);
            $callback = $_REQUEST["CKEditorFuncNum"];
            echo "<script type='text/javascript'>window.parent.CKEDITOR.tools.callFunction($callback,'".$imageUrl."','');</script>";
        }
        
    }

    public function actionLogin()
    {
        if (!Yii::app()->user->isGuest) {
            $this->redirect(array('goods/admin'));
        }

        if (Yii::app()->request->isPostRequest && isset($_POST['name'], $_POST['password'])) 
        {
            $identity = new UserIdentity($_POST['name'], $_POST['password']);
            if ($identity->authenticate()) {
                $duration = 86400;
                Yii::app()->user->login($identity, $duration);
                $this->redirect(array('goods/admin'));
            }else
            {
                 $this->redirect(array('site/login','flag'=>1));
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
