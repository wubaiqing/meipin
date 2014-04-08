<?php
/**
 * 商城管理
 * @author wubaiqing<wubaiqing@vip.qq.com>
 * @copyright Copyright (c) 2013 今天值得买
 * @since 1.5
 */
class Store extends ActiveRecord implements IArrayable
{

    /**
     * @var integer 搜索类型
     */
    public $searchType = '';

    /**
     * @var string 搜索内容
     */
    public $searchInput = '';

    public function tableName()
    {
        return '{{store}}';
    }

    /**
     * 关联分类
     * @return array
     */
    public function relations()
    {
        return array(
            'cat' => array(self::BELONGS_TO, 'StoreCat', 'cat_id'),
        );
    }

    /**
     * 验证规则
     * @return array
     */
    public function rules()
    {
        return array(
            array('name, url, spread, logo, cat_id', 'required'),
            array('id, name, url, spread, logo, status, list_order, created_at, update_at, cat_id, searchType, searchInput','safe'),
        );
    }

    /**
     * 字段属性名称
     * @return array
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'name' => '网站名称',
            'url' => '网站',
            'spread' => '推广链接',
            'cat_id' => '网站分类',
            'logo' => 'LOGO',
            'status' => '状态',
        );
    }

    /**
     * 列表搜索
     * @return ActiveDataProvider
     */
    public function search()
    {
        $criteria = new CDbCriteria(array(
            'order' => 'id Desc',
        ));

        $criteria->compare('name', $this->searchInput, true);

        return new ActiveDataProvider($this, array(
            'criteria' => $criteria
        ));
    }

    /**
     * 所有商城缓存Key
     * @return string
     */
    public static function getAllCacheKey()
    {
        return 'get-store-all-cachekey';
    }

    /**
     * 所有已添加的商城
     * @return object
     */
    public static function getAll()
    {
        // 缓存名称
        $cacheKey = self::getAllCacheKey();

        $data = array();
        $data = Yii::app()->cache->get($cacheKey);
        if (!empty($data)) {
            return $data;
        }

        $data = self::model()->findAll(array(
            'select' => 'id, name',
        ));

        Yii::app()->cache->set($cacheKey, $data , 1800);

        return $data;
    }
}
