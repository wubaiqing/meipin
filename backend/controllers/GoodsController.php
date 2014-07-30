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
                'actions' => array('test1','modifyOrder', 'getYiqifa', 'checkTbId', 'count', 'getUWebsiteData', 'getUHTML', 'getGoods', 'getGoodsP', 'getu', 'changeStatus'),
                'users' => array('@'),
            ),
        ),parent::accessRules());
    }

    //判断是否登陆，没有登陆就返回登陆
    public function beforeAction($action)
    {
       if (!Yii::app()->user->id) {
         $this->redirect(array('site/login'));
       }

       return parent::beforeAction($action);
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
        if(isset($_GET['Goods'])) {
	        $model->attributes = $_GET['Goods'];
            $model->status="";
        } else {
	        $model->status = '= 1';
        }

        $this->render('admin',array(
            'model' => $model,
        ));
    }

    /*
     *商品统计
    */
    public function actionCount()
    {
        $model = new Goods();
        $model->attributes = Yii::app()->request->getQuery(CHtml::modelName($model));
        $this->render("goodsinfo",['goodsmodel'=>$model]);
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
            //首页显示
            if ($_POST['Goods']['head_show']==2) {
                    $model->head_show =time();//获取首页是否显示字段
                    $model->start_time =date('Y-m-d H:i:s',time());//获取当前时间
                    $year=date('Y-m-d h:i:s',strtotime("+1 year"));//获取一年后时间
                    $model->end_time =$year;//获取结束时间
                    //记录选择选择录入时间
                    $model->log_start_time= strtotime($_POST['Goods']['start_time']);//记录操作开始时间
                    $model->log_end_time=strtotime($_POST['Goods']['end_time']);//记录操作结束时间
                }
            if ($model->save()) {
                //插入操作记录
                UserLoginLog::addOperation("添加({$model->id}的商品)");
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
        $modelShow=new Goods;
        $pictureold = $model->picture;

        if (isset($_POST['Goods'])) {
            // 设置商品类型
            //如果不等于原图并且是在阿里云上的则删除原图
            if ($model->picture != $_POST['Goods']['picture']) {

                //http://wubaiqing.oss-cn-hangzhou.aliyuncs.com/images/2014/06/13/sfh9s1402642385539a9fd190b32.jpg
                $domain = strstr($pictureold, 'aliyuncs.com');
                if ($domain) {
                    $picoldkey =  strstr($domain, 'images/');
                    //阿里云接口
                    if ($picoldkey) {
                        Yii::import('common.extensions.aliyunapi.OSSClient2');
                        $OSSClient = new OSSClient2;
                        $OSSClient->deleteObject($picoldkey);
                    }

                }

            }
            $model->goodsType = $goodsType;

            $_POST['Goods']['goods_type'] = $goodsType;
            $model->attributes = $_POST['Goods'];

            // 根据商品类型设置淘宝ID
            if ($model->goodsType != 0) {
                $model->tb_id = 0;
            }
            if ($_POST['Goods']['head_show']!=3) {
                //首页显示
                if ($_POST['Goods']['head_show']==2) {
                        $model->head_show =time();//获取首页是否显示字段
                        $model->start_time =date('Y-m-d H:i:s',time());//获取当前时间
                        $year=date('Y-m-d h:i:s',strtotime("+1 year"));//获取一年后时间
                        $model->end_time =$year;//获取结束时间
                        //记录选择选择录入时间
                        $model->log_start_time= strtotime($_POST['Goods']['start_time']);//记录操作开始时间
                        $model->log_end_time=strtotime($_POST['Goods']['end_time']);//记录操作结束时间
                    }
                //首页不显示
                if ($_POST['Goods']['head_show'] == 1) {
                    $model->head_show ='';//获取首页是否显示字段
                    $model->start_time =date('Y-m-d H:i:s',$model['log_start_time']);//还原创建开始时间
                    $model->end_time =date('Y-m-d H:i:s',$model['log_end_time']);//还原创建结束时间
                    //var_dump($model['log_start_time']);die;
                }
            }
            if ($model->save()) {
                //插入操作记录
                UserLoginLog::addOperation("修改({$model->id}的商品)");
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
     * 修改商品排序
     */
    public function actionModifyOrder($order,$id)
    {
        $goods = Goods::model()->findByPk($id);
        $list_order = $order;
        Goods::model()->updateByPk($id, array('list_order' => $list_order));
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
