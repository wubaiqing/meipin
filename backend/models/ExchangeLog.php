<?php

/**
 * 美品网商品兑换记录
 * @author liukui <liujickson@gmail.com>
 * @copyright Copyright (c) 2014 美品网
 * @since 1.0
 * @property integer $id
 * @property integer $user_id
 * @property string $username
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $goods_id
 * @property string $remark
 * @property integer $city_id
 * @property string $address
 * @property string $postcode
 * @property string $mobile
 *
 */
class ExchangeLog extends ActiveRecord implements IArrayable
{

    /**
     * 发货状态
     * @var array
     */
    static $status = [0 => '未发货', 1 => '已发货'];

    /**
     * 搜索状态显示
     * @var array
     */
    static $statusSearch = ['' => '请选择', 0 => '未发货', 1 => '已发货'];

       /**
     * 搜索状态显示
     * @var array
     */
    static $pay_status = [ 0 => '未支付', 1 => '已支付'];

    /**
     * 搜索状态显示
     * @var array
     */
    static $zhushui = [ "<>''" => '正常', "=''" => '注水'];

    /**
     * 省份ID
     * @var integer
     */
    public $province;

    /**
     * 兑换商品实体
     * @var Exchange
     */
    public $exchangeModel;
    public $userModel;
    public function init()
    {
        parent::init();
        $this->exchangeModel = new Exchange();
        $this->userModel = new Users();
    }

    /**
     * 表名
     * @return string
     */
    public function tableName()
    {
        return '{{meipin_exchange_log}}';
    }

    /**
     * @return array 验证规则.
     */
    public function rules()
    {
        return [
            [
                'username', 'checkUsername',
            ],
            [
                'id, user_id,created_at,updated_at,goods_id,city_id',
                'numerical',
                'integerOnly' => true
            ],
            [
                'logistics','checkLogistic',
            ],
            [
                'id,name,username,updated_at,remark,user_id,,created_at,goods_id,status,city_id,address,postcode,mobile,logistics,logistics_code,delivery_time,pay_status',
                'safe'
            ],
        ];
    }

    /**
     * @return array 字段别名 (字段名=>备注)
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => '用户ID',
            'username' => '用户名',
            'created_at' => '兑换时间',
            'updated_at' => '更新时间',
            'city_id' => '城市ID',
            'address' => '配送地址',
            'goods_id' => '商品ID',
            'gdscolor' => '颜色'
        ];
    }

    /**
     * 多表关连查询
     */
    public function relations()
    {
        return array(
            'users' => array(self::HAS_ONE, 'Users', ['id' => 'user_id'], 'together' => true),
            'exchange' => array(self::HAS_ONE, 'Exchange', ['id' => 'goods_id'], 'together' => true, 'joinType' => 'inner join'),
            'address' => array(self::HAS_ONE, 'UsersAddress', 'user_id', 'together' => true),
        );
    }

    /**
     * 获取发货状态
     * @param  integer $status 状态
     * @return array
     */
    public static function getStatus($status)
    {
        return isset(self::$status[$status]) ? self::$status[$status] : "未知";
    }

    /**
     * 列表搜索
     * @return ActiveDataProvider
     */
    public function search($data = [])
    {
        $criteria = new CDbCriteria;
        $criteria->compare('goods_id', $this->goods_id);
        $criteria->compare('pay_status', $this->pay_status);
        $criteria->compare('user_id', $this->user_id);
        $criteria->order = 't.created_at desc';
        if (!empty($this->exchangeModel->name)) {
            $criteria->compare('exchange.name', $this->exchangeModel->name, true);
        }
        if (!empty($this->userModel->username)) {
            $criteria->compare('users.username', $this->userModel->username, true);
        }
        $criteria->compare('t.status', $this->status);
        $criteria->compare('t.winner', $this->winner);
        $criteria->with = array('exchange', 'users');
        if (isset($data['goods_type'])) {
            $criteria->compare('exchange.goods_type', $data['goods_type']);
            if ($data['goods_type'] == 1) {
                $criteria->order = 't.winner desc,t.created_at desc';
            }
        }

        return new CActiveDataProvider($this, [
            'criteria' => $criteria,
        ]);
    }
    /**
     * 列表搜索
     * @return ActiveDataProvider
     */
    public function searchLottery()
    {
        $criteria = new CDbCriteria;
        $criteria->compare('goods_id', $this->goods_id);
        $criteria->compare('pay_status', 1);
        //$criteria->order = 't.created_at desc';
        if (!empty($this->exchangeModel->name)) {
            $criteria->compare('exchange.name', $this->exchangeModel->name, true);
        }
        $criteria->compare('t.status', $this->status);
        $criteria->with = array('exchange', 'users');
        $criteria->order = 't.winner desc,t.created_at desc';

        return new CActiveDataProvider($this, [
            'criteria' => $criteria,
        ]);
    }

    /**
     * 更新用户兑换地址
     * @param  integer $id   数据主键ID
     * @param  array   $post 页面post数据
     * @return boolean
     */
    public static function upateAddress($id, $post)
    {
        try {
            $model = self::model()->findByPk($id);
            $model->attributes = $post;
            $model->update(['name', 'mobile', 'postcode', 'remark', 'city_id', 'address']);

            return true;
        } catch (\Exception $ex) {
            return false;
        }
    }

    /**
     * 生成商品详细页地址
     * @param  self   $data
     * @return string
     */
     public static function getDetailurl($data)
     {
        if ($data->goods_type==0) {
            return $url = "http://www.meipin.com/exchange/detail_".Des::encrypt($data->id).".html";
        } else {
            return $url = "http://www.meipin.com/exchange/raffle_".Des::encrypt($data->id).".html";
        }
     }
    /**
     * 更新发货状态
     * @param  integer $id   数据主键ID
     * @param  array   $post 页面post数据
     * @return boolean
     */
    public static function updateStatus($id, $post = [])
    {
        $post['updated_at'] = time();
        ExchangeLog::model()->updateByPk($id, $post);

        return true;
    }

    /**
     * 清除列表缓存
     * @param integer $goodsId 兑换商品ID
     */
    public static function deleteExchangeLogListCache($goodsId)
    {
        $maxCachePageCount = Yii::app()->params['pageCahceMaxCount'];
        for ($i = 1; $i <= $maxCachePageCount; $i++) {
            $cacheKey = self::getLogListKey($goodsId, $i);
            Yii::app()->cache->delete($cacheKey);
        }
    }

    /**
     * 获取记录
     * @param integer $goodsId 兑换商品ID
     * @param integer $page    当前页数
     */
    public static function getLogListKey($goodsId, $page)
    {
        return 'get-exchangelog-list-cachekey-' . $goodsId . "-" . $page;
    }

    /**
     * 配置注水相关数据
     */
    public function checkUsername()
    {
        if (empty($this->username)) {
            $this->addError("usernmae", "用户名不能为空");
        }

        $this->created_at = time();
        $this->status = 0;
    }

    /**
     * 获取参与用户数
     * @param  integer $goods_id 商品ID
     * @return integer
     */
    public static function getUserCount($goods_id)
    {
        $data = ExchangeLog::model()->count([
            'condition' => 'goods_id=:goods_id',
            'params' => [":goods_id" => $goods_id],
            'group' => 'username'
        ]);

        return $data;
    }

    /**
     * 查询注水中奖用户
     * @param  integer     $goods_id 商品ID
     * @return ExchangeLog
     */
    public static function findWatterList($goods_id)
    {
        return self::model()->findAll("user_add >0  and goods_id=$goods_id");
    }

    /**
     * 生成列表物流信息
     * @param  self   $data
     * @return string
     */
    public static function getLogistics($data)
    {
        $logisticsSystem = Yii::app()->params['logisticsSystem'];
        $logistics = ((isset($logisticsSystem[$data->logistics]) && $data->logistics>0)?$logisticsSystem[$data->logistics]:"未填写");
        $logistics_code = (empty($data->logistics_code))?"未填写":$data->logistics_code;
        $fhshi='';
        if ($data->delivery_time) {
            $fhshi = '发货:'.date('Y-m-d H:i:s',$data->delivery_time);
        }

        return "物流公司:".$logistics."<br/> 快递单号:".$logistics_code."<br/>".$fhshi;
    }
    public function checkLogistic()
    {
        if ($this->status == 1) {
            if (empty($this->logistics) || empty($this->logistics_code)) {
                $this->addError("logistic", "物流信息必须填写");
            }
        }
    }
}
