<?php
/**
 * 分类管理
 * @author wubaiqing<wubaiqing@vip.qq.com>
 * @copyright Copyright (c) 2013 今天值得买
 * @since 1.5
 */
class Cat extends ActiveRecord implements IArrayable
{
    /**
     * 表名
     * @return string
     */
    public function tableName()
    {
        return '{{meipin_category}}';
    }

    /**
     * 验证规则
     * @return array
     */
    public function rules()
    {
        return array(
            array('name', 'required'),
            array('name', 'length', 'max' => 255),
            array('parent_id, created_at, updated_at', 'numerical', 'integerOnly' => true),
        );
    }

    /**
     * 字段属性名称
     * @return array
     */
    public function attributeLabels()
    {
        return array(
            'id' => '分类ID',
            'name' => '名称',
            'parent_id' => '父级',
            'created_at' => '创建时间',
            'updated_at' => '更新时间',
        );
    }

    /**
     * 列表搜索
     * @return object ActiveDataProvider
     */
    public function search()
    {
        return new ActiveDataProvider($this);
    }

    /**
     * Get parent category
     * @return null | Cat
     */
    public function getParent()
    {
        return $this->findByPk($this->parent_id);
    }

    /**
     * 分类列表缓存Key
     * @return string 缓存名称
     */
    public static function getAllCatCacheKey()
    {
        return 'get-cate-all-cachekey';
    }

    /**
     * 得到所有分类
     * @return array
     */
    public static function getAllCat()
    {
        // 缓存名称
        $cacheName = self::getAllCatCacheKey();

        // 取缓存数据
        $catArr = array();
        $catArr = Yii::app()->cache->get($cacheName);
        if (!empty($catArr)) {
            return $catArr;
        }

        // 查询设置缓存
        $cate = self::model()->findAll(array(
            'order' => 't.id asc'
        ));
        foreach ($cate as $key => $item) {
            $array = array();
            $array['id'] = $item->id;
            $array['name'] = $item->name;
            $catArr[$item->id] = $array;
        }

        Yii::app()->cache->set($cacheName, $catArr, 1800);

        return $catArr;
    }
}
