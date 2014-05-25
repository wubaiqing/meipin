<?php

/**
 * 美品网商城数据
 * @author wubaiqing <wubaiqing@vip.qq.com>
 * @copyright Copyright (c) 2014 美品网
 * @since 1.0
 */
class Score extends ActiveRecord implements IArrayable
{

    /**
     * 页面操作类型
     * @var array
     */
    static $page_type = ['index' => 0, 'add' => 1, 'reduce' => 2];

    /**
     * 表名
     * @return string
     */
    public function tableName()
    {
        return '{{meipin_score}}';
    }

    /**
     * @return array 验证规则
     */
    public function rules()
    {
        return [
            ['id, score,user_id,reason,created_at,updated_at', 'numerical', 'integerOnly' => true],
            ['id,score,user_id,reason,remark,created_at,updated_at', 'safe'],
        ];
    }

    /**
     * 获取名称
     * @param  integer $id 商城ID
     * @return string  商城名称
     */
    public static function getScoreByUserId($user_id, $type = 'index', $page = 1)
    {
        $maxCachePageCount = Yii::app()->params['pageCahceMaxCount'];
        // 缓存名称
        $cacheKey = self::getScoreKey($user_id, $type, $page);

        // 得到缓存数据
        if ($page <= $maxCachePageCount) {
            $name = Yii::app()->cache->get($cacheKey);
            if (!empty($name)) {
                return $name;
            }
        }
        $scoreList = [];
        $scorePaginate = Score::model()->dataList($user_id, $type)->paginate(Yii::app()->params['scorePageSize']);
        $scoreList['pager'] = $scorePaginate->getPagination();
        $scoreList['data'] = $scorePaginate->data;

        // 设置缓存
        if ($page <= $maxCachePageCount) {
            Yii::app()->cache->set($cacheKey, [
                'pager' => $scoreList['pager'],
                'data' => $scoreList['data']
                    ], Constants::T_SECOND_TEN);
        }

        return $scoreList;
    }

    /**
     * 获取名称
     * @param  integer $id 商城ID
     * @return string  商城名称
     */
    public static function getScoreKey($user_id, $type = 'index', $page = 1)
    {
        return 'meipin-score-' . $user_id . '-' . $type . '-' . $page;
    }

    /**
     * 获取积分列表缓存KEY列表
     * @return array
     */
    public static function getScoreListKeys($userId)
    {
        $maxCachePageCount = Yii::app()->params['pageCahceMaxCount'];
        $result = [];
        for ($i = 1; $i < $maxCachePageCount; $i++) {
            foreach (self::$page_type as $k => $v) {
                $result[] = self::getScoreKey($userId, $k, $i);
            }
        }

        return $result;
    }

    public static function deleteScoreListCache($userId)
    {
        $maxCachePageCount = Yii::app()->params['pageCahceMaxCount'];
        for ($i = 1; $i < $maxCachePageCount; $i++) {
            foreach (self::$page_type as $k => $v) {
                $key = self::getScoreKey($userId, $k, $i);
                Yii::app()->cache->delete($key);
            }
        }
    }

    /**
     * 数据SQL条件
     * @param  integer $cat 分类ID
     * @return object  yii dbcriteria
     */
    public function dataList($user_id, $type)
    {
        $criteria = new CDbCriteria;
        $criteria->select = '*';
        $criteria->order = 'id DESC';
        $criteria->compare('user_id', '=' . $user_id);
        if ($type == 'add') {
            $criteria->compare('score', '>=0');
        } elseif ($type == 'reduce') {
            $criteria->compare('score', '<0');
        }
        $this->dbCriteria->mergeWith($criteria);

        return $this;
    }

    /**
     *
     */
    public static function getScoreTitle($type_id)
    {
        $type_list = [
            1 => '签到增加',
            2 => '连续签到2天增加',
            3 => '连续签到3天增加',
            4 => '连续签到3天以上增加',
            5 => '商品兑换',
            6 => '积分兑换',
        ];

        return $type_list[$type_id];
    }

}
