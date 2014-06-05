<?php
/**
 * API接口管理
 * @author wubaiqing<wubaiqing@vip.qq.com>
 * @copyright Copyright (c) 2013 今天值得买
 * @since 1.5
 */
class LinksController extends Controller
{
    //判断是否登陆，没有登陆就返回登陆
    public function beforeAction($action)
    {
       if (!Yii::app()->user->id) {
         $this->redirect(array('site/login'));
       }

       return parent::beforeAction($action);
    }
    /**
     * 访问权限
     */
    public function accessRules()
    {
        return array();
    }

    public function actionAdmin()
    {
        $model = new Links();
        $model->source = '=2';
        $this->render('admin', array(
            'model' => $model
        ));
    }

    public function actionCreate()
    {
        $model = new Links();
        if (isset($_POST['Links'])) {
            $model->attributes = $_POST['Links'];
            $model->source = 2;
            if (strpos($model->url, 'http://') === false) {
                $model->url = 'http://' . $model->url;
            }
            if ($model->save()) {
                $this->redirect(array('admin'));
            }
        }
        $this->render('create', array(
            'model' => $model
        ));
    }

    public function actionDelete($id)
    {
        if ($id > 0) {
            Links::model()->deleteByPk($id);
            $this->redirect(array('admin'));
        }
    }

    public function actionUpdate($id)
    {
        $model = Links::model()->findByPk($id);
        if (isset($_POST['Links'])) {
            $model->attributes = $_POST['Links'];
            $model->source = 2;
            if (strpos($model->url, 'http://') === false) {
                $model->url = 'http://' . $model->url;
            }
            if ($model->save()) {
                $this->redirect(array('admin'));
            }
        }
        $this->render('update', array(
            'model' => $model
        ));
    }

    public function actionList()
    {
        $links = Links::model()->findAll(array(
            'condition' => 'source =:source',
            'params' => array('source' => '1'),
            'order' => 'id asc'
        ));
        $this->render('list', array(
            'model' => $links
        ));
    }

    /**
     * 添加书签
     * @param string $name 书签名称
     * @param string $url  书签URL
     */
    public function actionAddBookmark($imageUrl, $url)
    {
        header("Content-Type:application/json;");
        $imageUrl = trim($imageUrl);
        $url = trim($url);
        if (empty($imageUrl) || empty($url)) {
            echo json_encode(array('code' => '2', 'errorLog' => '名称和地址不能为空'));
            Yii::app()->end();
        }
        if (strpos($url, 'http://') === false) {
            $url = 'http://' . $url;
        }
        if (strpos($imageUrl, 'http://') === false) {
            $imageUrl = 'http://' . $imageUrl;
        }

        $isBookmark = Links::model()->find(array(
            'condition' => 'url=:url And source =:source',
            'params' => array(':url' => $url, 'source' => '1')
        ));
        if ($isBookmark) {
            echo json_encode(array('code' => '2', 'errorLog' => '网址存在'));
            Yii::app()->end();
        }

        $bookmark = new Links();
        $bookmark->image_url = $imageUrl;
        $bookmark->url = $url;
        $bookmark->save();
        echo json_encode(array('code' => '1', 'errorLog' => '保存成功'));
    }

    /**
     * 删除书签
     * @param string $name 书签名称
     * @param string $url  书签URL
     */
    public function actionDeleteBookmark($imageUrl, $url)
    {
        header("Content-Type:application/json;");
        $imageUrl = trim($imageUrl);
        $url = trim($url);
        if (empty($imageUrl) && empty($url)) {
            echo json_encode(array('code' => '2', 'errorLog' => 'Logo或地址不能为空'));
            Yii::app()->end();
        }
        if (strpos($url, 'http://') === false) {
            $url = 'http://' . $url;
        }
        if (!empty($imageUrl) && strpos($imageUrl, 'http://') === false) {
            $imageUrl = 'http://' . $imageUrl;
        }

        if (!empty($imageUrl)) {
            $condition = array('condition' => 'image_url=:image_url','params' => array(':image_url' => $imageUrl));
        } else {
            $condition = array('condition' => 'url=:url','params' => array(':url' => $url));
        }

        $links = Links::model()->find($condition);
        if (empty($links)) {
            echo json_encode(array('code' => '2', 'errorLog' => '没有找到友情链接'));
            Yii::app()->end();
        }
        $links->delete();
        echo json_encode(array('code' => '1', 'errorLog' => '删除成功'));
    }
}
