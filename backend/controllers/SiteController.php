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
        $domain = "http://wubaiqing.oss-cn-hangzhou.aliyuncs.com/";
        $upload = new Upload('file');
        $upload->setOptions(array(
            'savePath' => 'images',
            'allowTypes' => array('image/jpeg', 'image/png'),
            'allowSize' => 1024 * 1024 * 5, // 5MB
        ));

        //阿里云接口
        Yii::import('common.extensions.aliyunapi.OSSClient2');
        $OSSClient = new OSSClient2;
        $Tempfile = $upload->gettmpName(); //临时文件路径
        $key = $upload->getFullPath2(); //key
        $content = fopen($Tempfile, 'r');
        $size= filesize($Tempfile);
        $return = $OSSClient ->putResourceObject($key, $content, $size);
        
        $data = array(
                'success' => true,
                'path' => $domain.$key, //存储路径 /2014/06/13/kQbnQ1402637670539a8d66ba0f9.jpg

        );
        if (!is_string($return)) 
        { 
            $data = array(
                'success' => false,
                'message' => '阿里云接口出错',
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
