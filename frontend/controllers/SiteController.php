<?php

/**
 * 美品网首页
 * @author wubaiqing<wubaiqing@vip.qq.com>
 * @copyright Copyright (c) 2014 美品
 * @since 1.0
 */
class SiteController extends Controller
{

    /**
     * @var string $layout 继承视图
     */
    public $layout = '//layouts/index';

    /**
     * 今天值得买首页
     */
    public function actionIndex($page = 1, $hot = 0, $cat = 0)
    {
        // 收取商品
        $goods = Goods::getGoodsList($cat, $hot, $page);

        //首页获取积分兑换的商品
        if($page==1)
        {
            $exchange = Exchange::getIndexExchange();
            $brand = Brand::getIndexBrand();
        }else
        {
            $brand = "";
            $exchange ="";
        }
         //print_r($brand);
        // 渲染首页
        $this->render('index', array(
            'cat' => $cat, // 分类
            'hot' => $hot, // 热门
            'page' => $page, // 当前页
            'goods' => $goods['data'], // 商品数据
            'pager' => $goods['pager'], // 商品翻页
            'exchange'=>$exchange,
            'brand'=>$brand
        ));
    }

    /*腾讯临时验证*/
    public function actionLinshi()
    {
        $this->layout = '';
        $this->render('linshi');
    }
    /**
     * 商品预告
     */
    public function actionTomorrow($page = 1, $hot = 0, $cat = 0)
    {
       
		$start_today=strtotime((date('Y-m-d',time()).'00:00:00'));//获取当天凌晨时间
		$end_today=strtotime((date('Y-m-d',time()).'15:59:59'));//获取当天下午四点时间
		$now_time=time();
		if ($now_time > $end_today ) { 
			// 收取商品
				$goods = Goods::tomorrow($cat, $hot, $page);
			} else {
				$goods=array();
				$goods['data']=array(); // 商品数据
				$goods['pager']=array(); // 商品翻页
			 }
        $exchange ="";
        // 渲染首页
        $this->render('tomorrow', array(
            'cat' => $cat, // 分类
            'hot' => $hot, // 热门
            'page' => $page, // 当前页
            'goods' => $goods['data'], // 商品数据
            'pager' => $goods['pager'], // 商品翻页
            'exchange'=>$exchange
        ));
    }

    /**
     * 今天值得买首页
     */
    public function actionBuy($id)
    {
        $goodsId = Des::decrypt($id);
        $goods = Goods::getGoods($goodsId);
        if (!empty($goods)) {
            header("Location:{$goods->url}");
            Yii::app()->end();
        }
    }


    /**
     * 今天值得买首页  --不能删
     */
    public function actionOut($id,$page=1,$hot=0, $skip = 0)
    {
        $goodsId = Des::decrypt($id);
        $goods = Goods::getGoods($goodsId);
		if ($goods->is_skip == 1) {
			header('Location:' . $goods->url);
			Yii::app()->end();
		}
        $hotExchangeGoods = Exchange::getHotExchangeDetailGoods();
        $xggoods = Goods::getXgGoodsList($goods->cat_id,$hot, $page,$goods->id);
        Yii::app()->params['title'] =$goods->title."-美品网"; //详细页title
        $this->render('goodsdetail', array(
        	'cat'=>0,
        	'goods'=>$goods,
        	'hotExchangeGoods'=>$hotExchangeGoods,
            'hot' => $hot, // 热门
            'page' => $page, // 当前页
            'xggoods' => $xggoods['data'], // 商品数据
            'pager' => $xggoods['pager'], // 商品翻页
        	));
    }
    /**
     *  意見反饋
     */
    public function actionfeedback()
    {
        $this->layout = '//layouts/userBase';
        $model = new FeedBack();

        $post = Yii::app()->request->getPost('FeedBack');
        //var_dump($post);
        if (!empty($post)) {
            $model->attributes = $post;
            //print_r($model->attributes);
            if ($model->save()) {
                $this->renderIndex('yes', '感谢您的建议我们将及时回馈', '/');
            }
        }
        $this->render('feedback', ['model' => $model]);
    }

    /**
     *  关于我们
     */
    public function actionAbout()
    {
        $this->layout = '//layouts/userBase';

        $this->render('about');
    }

    /**
     *  联系我们
     */
    public function actionConnect()
    {
        $this->layout = '//layouts/userBase';
        $this->render('connect');
    } 
	/**
    *  导航手机APP
    */
    public function actionPhone()
    {
        $this->layout = '//layouts/userBase';
        $this->render('phone');
    }

    /**
     *  商家报名
     */
    public function actionBsrg()
    {
        $this->layout = '//layouts/userBase';
        $this->render('bsrg');
    }

    /**
     *  商家报名
     */
    public function actionMoreship()
    {
        $this->layout = '//layouts/userBase';
        $this->render('moreship');
    }

    /**
     * 跳转首页
     */
    public function renderIndex($status, $message, $url = '')
    {
        if (empty($url)) {
            $url = $this->createAbsoluteUrl('user/login');
        }
        $this->layout = '//layouts/userBase';
        $this->render('/user/loginSuccess', [
            'status' => $status,
            'message' => $message,
            'url' => $url
        ]);
        Yii::app()->end();
    }

    /**
     *  xiazai
     */
    public function actionXiazai()
    {

        $Shortcut = "[InternetShortcut]
        URL=http://www.meipin.com
        IDList=
        IconFile=（）
        IconIndex=1
        [{000214A0-0000-0000-C000-000000000046}]
        Prop3=19,2";
        Header("Content-type: application/octet-stream");
        header("Content-Disposition: attachment; filename=美品网.url;");
        echo $Shortcut;
    }

    /**
     * 幸运抽奖
     */
    public function actionRaffle($page = 1, $cat = 1003, $t = '')
    {
        //积分兑换首页商品列表
        $exchangeModel = new Exchange();
        $data = $exchangeModel->showExchangeGoodsList($page, 1, $t);
        //渲染頁面
        $this->render('/exchange/raffleList', [
            'cat' => $cat, // 分类
            'history'=>$t,//显示历史抽奖数据
            'page' => $page, // 当前页
            'goods' => $data['goods'], // 商品数据
            'pager' => $data['pages'], // 商品翻页
        ]);
    }

    function actionDownload()
    {
        $this->layout = "";
        $this->render('download');
    }

}
