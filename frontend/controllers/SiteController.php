<?php
/**
 * 美品网首页
 * @author wubaiqing<wubaiqing@vip.qq.com>
 * @copyright Copyright (c) 2014 美品
 * @since 1.0
 */
class SiteController extends Controller
{
    public function actions()
    { 
        return array( 
            'captcha'=>array(
                'class'=>'CCaptchaAction',
                'backColor'=>0xFFFFFF, 
                'maxLength'=>'4',
                'minLength'=>'4',
                'height'=>'30',
                'width'=>'80',
            ), 
        ); 
    }

    public function rules()
    {
        return array(  
            array('verifyCode', 'captcha', 'on'=>'login', 'allowEmpty'=> !extension_loaded('gd')),  
        );  
    }

    /**
     * @var string $layout 继承视图
     */
    public $layout = '//layouts/main';

    /**
     * 今天值得买首页
     */
    public function actionIndex($page = 1, $hot = 0, $cat = 0)
    {
        $goods = Goods::getGoodsList($cat, $hot);
        $count = count(Goods::getGoodsList(0, 0)['data']);
        $cat = Yii::app()->request->getQuery('cat');
        $this->render('index', array(
            'cat' => $cat,
            'count' => $count,
            'goods' => $goods['data'],
            'pager' => $goods['pager'],
        ));
    }

}
