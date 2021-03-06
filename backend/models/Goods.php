<?php
/**
 * 分类管理
 * @author wubaiqing<wubaiqing@vip.qq.com>
 * @copyright Copyright (c) 2013 今天值得买
 * @since 1.5
 */
class Goods extends ActiveRecord implements IArrayable
{
    /**
     * @var array $statusLabels 商品状态
     */
    public static $statusLabels = array(
        '1' => '正常',
        '2' => '隐藏',
    );
    public static $statussellLabels = array(
        '1' => '正常',
        '2' => '售完',
    );
    public static $change_price = array(
        '0' => '否',
        '1' => '是',
    );

   public static $shunfeng = array(
        '0' => '否',
        '1' => '是',
    );
    /**
     * @var integer 搜索类型
     */
    public $searchType = '';

    /**
     * @var integer 排序类型
     */
    public $gdorder = '';

    /**
     * @var string 搜索内容
     */
    public $searchInput = '';

    /**
     * @var string 商品类型
     */
    public $goodsType = 1;

    /**
     * 添加前行为
     */
    public function init()
    {
        parent::init();
        $this->onBeforeSave = array($this, 'timeHandle');
    }

    /**
     * 格式化时间戳
     */
    public function timeHandle()
    {
        $startTime = new DateTime($this->start_time);
        $this->start_time = $startTime->getTimestamp();
        $endTime = new DateTime($this->end_time);
        $this->end_time = $endTime->getTimestamp();
    }

    /**
     * 表名
     * @return string
     */
    public function tableName()
    {
        return '{{meipin_goods}}';
    }

    /**
     * 验证规则
     * @return array
     */
    public function rules()
    {
        return array(
            array('goods_type, cat_id, title, url, origin_price, price, picture, status, list_order, start_time, end_time, user_id, is_zhe800, is_skip,change_price', 'required'),
            array('tb_id, cat_id, status, list_order, created_at, updated_at, user_id', 'numerical', 'integerOnly' => true),
            array('origin_price, price', 'type', 'type' => 'float'),
        array('title, picture, searchInput', 'length', 'max' => 255),
            array('origin_price, price, searchType, gdorder,relation_website', 'length', 'max' => 8),
            array('start_time, end_time', 'date', 'format' => 'yyyy-M-d H:m:s'),
            array('tb_id', 'checkTaobaoId'),
            array('mark,pnum,sales,pbuy,comment,shunfeng', 'safe'),
        );
    }

    /**
     * 检测淘宝ID是否有重复
     */
    public function checkTaobaoId()
    {
        if ($this->scenario == 'insert' && $this->goodsType == 0) {
            $goods = Goods::model()->findByAttributes(array(
                'tb_id' => $this->tb_id
            ));
            if (!empty($goods)) {
                $this->addError('tb_id', '淘宝ID不能重复');
            }
        }
    }

    /**
     * 监测关联网站
     */
    public function checkRelationWebsite()
    {
        if ($this->goodsType == 1 || $this->goodsType ==2) {
            if (empty($this->relation_website)) {
                $this->addError('relation_website', '关联网站 cannot be blank.');
            }
        }
    }

    /**
     * 字段属性名称
     * @return array
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'tb_id' => '淘宝ID',
            'cat_id' => '分类',
            'title' => '标题',
            'url' => '链接',
            'origin_price' => '原始价格',
            'price' => '现价',
            'picture' => '图片',
            'created_at' => '采集时间',
            'updated_at' => '更新时间',
            'list_order' => '排序',
            'start_time' => '开始时间',
            'end_time' => '结束时间',
            'status' => '状态',
            'head_show' => '首页永久显示',
            'goods_type' => 'URL转换类型',
            'relation_website' => '关联网站',
            'user_id' => '用户ID',
            'is_zhe800' => '商品来源',
            'admin_id' => '创建人',
            'is_skip' => '跳转',
            'change_price'=>'拍下减价',
            'mark'=>'宝贝评分',
            'sales'=>'宝贝销量',
            'pnum'=>'评价人数',
            'pbuy'=>'购买人数',
            'comment'=>'小编点评',
            'shunfeng'=>'顺丰包邮'

        );
    }

    /**
     * 列表搜索
     * @return ActiveDataProvider
     */
    public function search()
    {
        $criteria = new CDbCriteria;

        $criteria->compare("FROM_UNIXTIME(start_time,'%Y-%m-%d')",$this->start_time);
        if ($this->searchType == '1') {
            $criteria->compare('id', $this->searchInput);
        } elseif ($this->searchType == '2') {
            $criteria->compare('tb_id', $this->searchInput);
        } else {
            $title = trim($this->searchInput);
            $criteria->compare('title', $title, true);
        }
        $criteria->order = $this->gdorder." desc";
	    $criteria->compare('status', $this->status);

        return new ActiveDataProvider($this, array(
            'criteria' => $criteria,
            'pagination'=>array(
             'pageSize'=>Yii::app()->params['actdatapagesize'], //代表每页显示50条信息
            ),
        ));
    }

    /**
     * 设置淘宝客Cookie
     */
    public static function setTaobaoCookie()
    {
        $app_key = Yii::app()->params['appKey'];
        $secret = Yii::app()->params['secret'];
        $timestamp = time() . '000';
        $message = $secret . 'app_key' . $app_key . 'timestamp' . $timestamp . $secret;
        $mysign = strtoupper(hash_hmac('md5', $message, $secret));
        setcookie('timestamp', $timestamp);
        setcookie('sign', $mysign);
    }

    /**
     * 列表修改标题链接
     * @return string
     */
    public static function getUpdateLinkTitle($url, $title, $startTime, $endTime, $isActivity,$picture)
    {
        return '<a target="_blank" title="创建时间：'.date('Y-m-d H:i:s', $startTime). "\n修改时间：". date('Y-m-d H:i:s', $endTime).'" href="'.$url.'">'.$title.'</a> <br/><img src='.$picture.' width="100px" height="65px;" />';
    }

    /**
     * 根据商品返回不同模板
     * @param integer $type 商品类型
     */
    public static function getRenderTemplate($type)
    {
        // 1. 淘宝商品  2. b2c商品  3. 活动商品
        $renderTemplate = null;
        if ($type == 0) {
            $renderTemplate = '_taobao';
        } elseif ($type == 1) {
            $renderTemplate = '_b2c';
        } else {
            $renderTemplate = '_activity';
        }

        return $renderTemplate;
    }

    /**
     * U站HTML
     * @param object $goods
     */
    public static function getUHtml($goods)
    {
        $str = '<div class="today-goods-list">';
        foreach ($goods as $key => $val) {
            $str .= '<div class="dealbox"><div class="deal figure1 zt1"><div class=""><p><a data-itemid="'. $val->tb_id .'"href="'. $val->url.'"target="_blank"><img class="goods-item-img"src="'.$val->picture.'"title="'.$val->title.'"alt="'.$val->title.'"width="290"height="290"style="display: inline;"></a></p><h2><strong><a data-itemid="'.$val->tb_id.'"href="'.$val->url.'"target="_blank">【淘宝网】</a></strong><a data-itemid="'.$val->tb_id.'"href="'.$val->url.'"target="_blank">'.$val->title.'</a></h2><h4><span><em><b></b><em>'.$val->price.'</em></em></span><span><i>'.$val->origin_price.'</i></span><a data-itemid="'.$val->tb_id.'"href="'.$val->url.'"target="_blank"></a></h4><span class="mgicon"></span></div></div></div>';
        }
        $str .= '</div>';

        return $str;
    }

    /**
     * 发布商品内容
     */
    public static function getFinishGoods()
    {
        // 未结束和未开始商品
        $now = time();
        $criteria = new CDbCriteria;
        $criteria->index = 'tb_id';
        $criteria->select = 'tb_id';
        $criteria->order = 't.id DESC';
        $criteria->compare('t.end_time', '>='. $now);
        $goods = Goods::model()->findAll($criteria);
        $goods = array_keys($goods);

        $criteria = new CDbCriteria;
        $criteria->index = 'tb_id';
        $criteria->select = 'tb_id';
        $criteria->order = 't.id DESC';
        $blackList = BlackList::model()->findAll($criteria);
        $blackList = array_keys($blackList);

        return array_merge($goods, $blackList);
    }

    /**
     * 商品统计
     * @param  integer $startTime
     * @param  integer $endTime
     * @return integer
     */
    public static function getGoodsCount($type, $userId)
    {

        $criteria = new CDbCriteria;

        if ($type == 1) {
            $today = strtotime('today');
            $criteria->compare('t.created_at', '>='. $today);
        } elseif ($type == 2) {
            $today = strtotime('today');
            $endTime = strtotime('+ 1day 00:00:00') - 1;
            $criteria->compare('t.start_time', '>='. $today);
            $criteria->compare('t.start_time', '<='. $endTime);
            $criteria->compare('t.created_at', '>='. $today);
        } elseif ($type == 3) {
            $today = strtotime('today');
            $startTime = strtotime('+ 1day 00:00:00');
            $endTime = strtotime('+ 1day 23:59:59');
            $criteria->compare('t.start_time', '>='. $startTime);
            $criteria->compare('t.start_time', '<='. $endTime);
            $criteria->compare('t.created_at', '>='. $today);
        }
        $criteria->compare('t.user_id', '='.$userId);

        return Goods::model()->count($criteria);

    }

    /**
     * 手机端Criteria
     * @return object criteria
     */
    public static function getMobileCriteria()
    {
        $now = time();
        $criteria = new CDbCriteria;
        $criteria->select = '*, FROM_UNIXTIME(t.start_time, "%Y-%m-%d") as day';
        $criteria->order = 'day DESC, t.list_order DESC';
        $criteria->limit = 300;
        $criteria->compare('t.start_time', '<='. $now);
        $criteria->compare('t.end_time', '>='. $now);
        $criteria->compare('t.status', '=1');
        $criteria->compare('t.goods_type', '=0');

        return $criteria;
    }

    /**
     * 商品统计
     * @return array
     */
    public function getgoodsinfo()
    {

        $criteria = new CDbCriteria;
        $criteria->select = "FROM_UNIXTIME(updated_at,'%Y-%m-%d') as created_at,count(id) as id,user_id";
        $criteria->compare("FROM_UNIXTIME(updated_at,'%Y-%m-%d')", $this->created_at);
        $criteria->group="FROM_UNIXTIME(updated_at,'%Y-%m-%d'),user_id";
        $criteria->order = 'updated_at desc';
        return new CActiveDataProvider($this,
        [
            'criteria' => $criteria,
        ]);
    }

}
