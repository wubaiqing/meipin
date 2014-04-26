<?php
/**
 * 逛管理
 * @author wubaiqing<wubaiqing@vip.qq.com>
 * @copyright Copyright (c) 2013 今天值得买
 * @since 1.5
 */
class Guang extends ActiveRecord implements IArrayable
{
    /**
     * 表名
     * @return string
     */
    public function tableName()
    {
        return '{{guang}}';
    }

    /**
     * 验证规则
     * @return array
     */
    public function rules()
    {
        return array(
            array('cat_id, title, price, url, image, identify, created_at, updated_at', 'safe')
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
            'title' => '标题',
            'price' => '价格',
            'url' => 'url',
            'image' => 'image',
            'identify' => 'identify',
            'created_at' => 'created_at',
            'updated_at' => 'updated_at',
        );
    }

    /**
     * 数据列表
     */
    public function dataList($tagId)
    {
        $criteria = new CDbCriteria;
        $criteria->order = 'id desc';
        $criteria->limit = 80;
        if ($tagId != 0) {
            $criteria->compare('t.cat_id', '='.$tagId);
        }
        $this->dbCriteria->mergeWith($criteria);

        return $this;
    }

    /**
     * 逛缓存管理
     * @param  string $cacheKey 缓存Key
     * @return string
     */
    public static function getGuangListCache($cacheKey)
    {
        return 'get-guang-list-cache-' . $cacheKey;
    }
    /**
     * 逛列表
     * @param  string  $list 是否是列表
     * @param  intger  $page 当前页数
     * @param  integer $cat  当前分类
     * @return array   商品条件
     */
    public static function getGuangList($tagId, $page)
    {
        // 缓存名称
        $cacheKey = Guang::getGuangListCache($tagId . '-' . $page);

        // 商品列表
        $guangList = Yii::app()->cache->get($cacheKey);
        if (!empty($guangList)) {
            return $guangList;
        }

        // 商品列表数据
        $guangList = array();
        $guang = Guang::model()->dataList($tagId)->paginate();
        $guangList['pager'] = $guang->getPagination();
        $guangList['data'] = $guang->data;

        // 设置缓存
        Yii::app()->cache->set($cacheKey, array(
            'pager' => $guangList['pager'],
            'data' => $guangList['data']
        ) , 1800);

        return $guangList;
    }

    public static function getGuangCateId($goodsId)
    {
        $cacheKey = 'get-guang-cate-id-' . $goodsId;
        $result = Yii::app()->cache->get($cacheKey);
        if (!empty($result)) {
            return $result;
        }

        $criteria = new CDbCriteria();
        $criteria->limit = 12;
        $criteria->order = 'rand()';
        $result = Guang::model()->findAll($criteria);
        Yii::app()->cache->set($cacheKey, $result, 3600);

        return $result;
    }

}
