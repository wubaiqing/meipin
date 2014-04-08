<?php
/**
 * 收藏夹管理
 * @author wubaiqing<wubaiqing@vip.qq.com>
 * @copyright Copyright (c) 2013 今天值得买
 * @since 1.5
 */
class BookmarkController extends Controller
{
    /**
     * 访问权限
     */
    public function accessRules()
    {
        return array();
    }

    public function actionAdmin()
    {
        $bookmark = Bookmark::model()->findAll(array(
            'order' => 'id desc'
        ));
        $this->render('list', array(
            'model' => $bookmark
        ));
    }

    /**
     * 添加书签
     * @param string $name 书签名称
     * @param string $url  书签URL
     */
    public function actionAddBookmark($name, $url)
    {
        header("Content-Type:application/json;");
        $name = trim($name);
        $url = trim($url);
        if (empty($name) || empty($url)) {
            echo json_encode(array('code' => '2', 'errorLog' => '名称和地址不能为空'));
            Yii::app()->end();
        }
        if (strpos($url, 'http://') == false) {
            $url = 'http://' . $url;
        }

        $isBookmark = Bookmark::model()->find(array(
            'condition' => 'url=:url',
            'params' => array(':url' => $url)

        ));
        if ($isBookmark) {
            echo json_encode(array('code' => '2', 'errorLog' => '网址存在'));
            Yii::app()->end();
        }

        $bookmark = new Bookmark();
        $bookmark->name = $name;
        $bookmark->url = $url;
        $bookmark->save();
        echo json_encode(array('code' => '1', 'errorLog' => '保存成功'));
    }

    /**
     * 删除书签
     * @param string $name 书签名称
     * @param string $url  书签URL
     */
    public function actionDeleteBookmark($name, $url)
    {
        header("Content-Type:application/json;");
        $name = trim($name);
        $url = trim($url);
        if (empty($name) && empty($url)) {
            echo json_encode(array('code' => '2', 'errorLog' => '名称或地址不能为空'));
            Yii::app()->end();
        }
        if (strpos($url, 'http://') == false) {
            $url = 'http://' . $url;
        }

        if (!empty($name)) {
            $condition = array('condition' => 'name=:name','params' => array(':name' => $name));
        } else {
            $condition = array('condition' => 'url=:url','params' => array(':url' => $url));
        }

        $bookmark = Bookmark::model()->find($condition);
        if (empty($bookmark)) {
            echo json_encode(array('code' => '2', 'errorLog' => '没有找到书签'));
            Yii::app()->end();
        }
        $bookmark->delete();
        echo json_encode(array('code' => '1', 'errorLog' => '删除成功'));
    }
}
