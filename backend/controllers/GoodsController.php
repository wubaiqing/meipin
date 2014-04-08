<?php
/**
 * 商品管理
 *
 * @author wubaiqing<wubaiqing@vip.qq.com>
 * @copyright Copyright (c) 2013 吴佰清
 * @since 1.4
 */
class GoodsController extends Controller
{
    /**
     * 访问权限
     */
    public function accessRules()
    {
        return array_merge(array(
            array('allow',
                'actions' => array('modifyOrder', 'getYiqifa', 'checkTbId', 'count', 'getUWebsiteData', 'getUHTML', 'getGoods', 'getGoodsP', 'getu', 'changeStatus'),
                'users' => array('@'),
            ),
        ),parent::accessRules());
    }

    public function actionGetGoods($taobaoId)
    {
        Yii::import('common.extensions.taobao.*');
        $taobao = new Taobao();
        $json = $taobao->getGoods($taobaoId);
        echo json_encode($json);
    }

    /**
     * 一起发接口
     * @param string $url 商品URL地址
     */
    public function actionGetYiqifa($url)
    {
        header('Content-Type:application/json;');
        Yii::import('common.extensions.yiqifa.*');
        $YQF = new Yiqifa();
        $goods = $YQF->getYiqifaGoods($url);
        echo $goods;
    }

    /**
     * 监测淘宝ID
     */
    public function actionCheckTbId($tbId)
    {
        $goods = Goods::model()->findByAttributes(array(
            'tb_id' => $tbId
        ));
        if (!empty($goods)) {
            echo '1';
        } else {
            echo '0';
        }
        Yii::app()->end();
    }

    /**
     * 商品管理
     */
    public function actionAdmin()
    {
        $model = new Goods('search');
        $model->unsetAttributes();
        if(isset($_GET['Goods']))
            $model->attributes = $_GET['Goods'];

        $this->render('admin',array(
            'model' => $model,
        ));
    }

    /**
     * 添加商品
     * @param integer $goodsType 商品类型
     */
    public function actionCreate($goodsType)
    {
        $model=new Goods;

        // 设置淘宝Cookie
        Goods::setTaobaoCookie();

        if (isset($_POST['Goods'])) {
            // 设置商品类型
            $model->goodsType = $goodsType;

            $_POST['Goods']['goods_type'] = $goodsType;
            $model->attributes = $_POST['Goods'];

            // 根据商品类型设置淘宝ID
            if ($model->goodsType != 0) {
                $model->tb_id = 0;
            }

            $model->user_id = User::getUserName(Yii::app()->user->id);

            if ($model->save()) {
                @file_get_contents('http://www.40zhe.com/api/getpushgoods/goodsId/'.$model->id.'.html');
                $this->redirect(array('admin'));
            }
        }

        // 根据商品返回不同模板
        $this->render('create',array(
            'model' => $model,
            'type' => $goodsType,
        ));
    }

    /**
     * 修改商品
     * @param integer $id        商品ID
     * @param integer $goodsType 商品类型
     */
    public function actionUpdate($id, $goodsType)
    {
        $model = $this->loadModel($id);

        if (isset($_POST['Goods'])) {
            // 设置商品类型
            $model->goodsType = $goodsType;

            $_POST['Goods']['goods_type'] = $goodsType;
            $model->attributes = $_POST['Goods'];

            // 根据商品类型设置淘宝ID
            if ($model->goodsType != 0) {
                $model->tb_id = 0;
            }

            if ($model->save()) {
                @file_get_contents('http://www.40zhe.com/api/getpushgoods/goodsId/'.$model->id.'.html');
                $this->redirect(array('admin'));
            }
        }

        $model->start_time = Yii::app()->format->datetime($model->start_time);
        $model->end_time = Yii::app()->format->datetime($model->end_time);

        $this->render('update',array(
            'model' => $model,
            'type' => $goodsType,
        ));
    }

    /**
     * 获取商品
     * @param integer $id 商品ID
     */
    public function loadModel($id)
    {
        $model = Goods::model()->findByPk($id);
        if($model === null)
            throw new CHttpException(404,'The requested page does not exist.');

        return $model;
    }

    /**
     * 修改商品排序
     */
    public function actionModifyOrder($order, $id)
    {
        $model = $this->loadModel($id);
        $model->list_order = $order;
        echo $model->save();
    }

    /**
     * 商品添加统计
     */
    public function actionCount()
    {
        $array = array();
        $userIds = array(2, 3, 4);
        foreach ($userIds as $userId) {
            $array = Yii::app()->db->createCommand('select count(*) c , from_unixtime(t.created_at, "%m月%d") weeks, user_id from goods as t where t.created_at >= UNIX_TIMESTAMP(CURRENT_DATE - interval 20 day)  group by weeks, user_id')->queryAll();
        }
        $this->render('_add_goods_count', array(
            'user' => $array
        ));
    }

    /**
     * U站数据
     */
    public function actionGetUWebsiteData()
    {
        $goods = Goods::model()->findAll(array(
            'order' => 'id DESC',
            'limit' => '300'
        ));
        foreach ($goods as $key => $val) {
            echo $val->title . "</br>";
            echo $val->url. "</br></br>";
        }
    }

    /**
     * U站HTML
     */
    public function actionGetUHtml()
    {
        $now = time();
        $limit = '45';

        $criteria = new CDbCriteria;
        $criteria->select = '*, FROM_UNIXTIME(t.start_time, "%Y-%m-%d") as day';
        $criteria->order = 'day DESC, t.list_order DESC, t.id DESC';
        $criteria->limit = $limit;
        $criteria->offset = 0 * $limit;
        $criteria->compare('t.start_time', '<='. $now);
        $criteria->compare('t.end_time', '>='. $now);
        $criteria->compare('t.status', '=1');
        $criteria->compare('t.goods_type', '=0');

        $goods = Goods::model()->findAll($criteria);
        $html0 = Goods::getUHtml($goods);

        $criteria->offset = 1 * $limit;
        $goods = Goods::model()->findAll($criteria);
        $html1 = Goods::getUHtml($goods);

        $criteria->offset = 0 * $limit;
        $criteria->compare('t.is_zhe800', '=2');
        $goods = Goods::model()->findAll($criteria);
        $html2 = Goods::getUHtml($goods);

        $criteria->offset = 1 * $limit;
        $criteria->compare('t.is_zhe800', '=2');
        $goods = Goods::model()->findAll($criteria);
        $html3 = Goods::getUHtml($goods);

        $this->render('_u',array(
            'html0' => $html0,
            'html1' => $html1,
            'html2' => $html2,
            'html3' => $html3,
        ));
    }

    /**
     * Android手机客户端输出JSON
     */
    public function actionGetU($catId = 0)
    {
        $now = time();
        $criteria = new CDbCriteria;
        $criteria->select = '*, FROM_UNIXTIME(t.start_time, "%Y-%m-%d") as day';
        $criteria->order = 'day DESC, t.list_order DESC';
        $criteria->limit = 200;
        $criteria->compare('t.start_time', '<='. $now);
        $criteria->compare('t.end_time', '>='. $now);
        $criteria->compare('t.status', '=1');
        $criteria->compare('t.goods_type', '=0');
        $criteria->compare('t.price', '>20');

        $criteria->addCondition("t.picture NOT LIKE '%40zhe%' And t.picture NOT LIKE '%qpic%'");
        $goods = Goods::model()->findAll($criteria);
        $values = '';
        $tbIds = array();
        foreach ($goods as $key => $item) {
            $tbIds[] = $item->tb_id;
            $title = urlencode($item->title);
            $values .= "('{$item->tb_id}', '{$title}', '{$item->cat_id}', '{$item->picture}', '{$item->start_time}', '{$item->end_time}', '{$item->price}', '{$item->origin_price}', '{$item->url}', '{$item->list_order}'), ";
        }
        $tbJoin = join(',', $tbIds);
        $content = substr($values, 0, -2);
        $delete = "Delete From goods Where tb_id in($tbJoin)";
        $insert = "Insert Into goods(tb_id, title, cat_id, img_url, start_time, end_time, price, origin_price, url, list_order) Values {$content};";

        $links = Links::model()->findAll();
        $linkIds = array();
        $values = '';
        foreach ($links as $key => $item) {
            $linkIds[] = $item->id;
            $values .= "('{$item->id}', '{$item->image_url}', '{$item->url}'), ";
        }
        $idJoin = join(',', $linkIds);
        $linkContent = substr($values, 0, -2);
        $linkDelete = '';
        if (!empty($idJoin)) {
            $linkDelete = "Delete From links";
            $linkInsert = "Insert Into links(id, image_url, url) Values {$linkContent};";
        } else {
            $linkInsert = "Delete From links";
        }

        $this->render('_zxzdm', array(
            'delete' => $delete,
            'insert' => $insert,
            'linkDelete' => $linkDelete,
            'linkInsert' => $linkInsert
        ));

        Yii::app()->end();
    }

    public function actionChangeStatus($id)
    {
        $goods = Goods::model()->findByPk($id);
        $status = 1;
        if ($goods->status == 1) {
            $status = 2;
        } else {
            $status = 1;
        }
        Goods::model()->updateByPk($id, array('status' => $status));
    }
}
