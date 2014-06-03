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
       $v= $model->unsetAttributes();
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
     * 修改商品状态
     */
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
	/**
     * 修改商品是否销售完状态
     */
    public function actionChangesellStatus($id)
    {
        $goods = Goods::model()->findByPk($id);
        $sell_status = 1;
        if ($goods->sell_status == 1) {
            $sell_status = 2;
        } else {
            $sell_status = 1;
        }
        Goods::model()->updateByPk($id, array('sell_status' => $sell_status));
    }
}
