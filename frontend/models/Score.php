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
     * 表名
     * @return string
     */
    public function tableName()
    {
        return '{{meipin_score}}';
    }

    /**
     * 获取名称
     * @param  integer $id 商城ID
     * @return string  商城名称
     */
    public static function getScoreByUserId($user_id,$type='index',$page=1)
    {
        // 缓存名称
        $cacheKey = 'meipin-score-'.$user_id.'-'.$type.'-'.$page;

        // 得到缓存数据
        $name = Yii::app()->cache->get($cacheKey);
        if (!empty($name)) {
            return $name;
        }

        $scoreList = [];
        $scorePaginate = Score::model()->dataList($user_id, $type)->paginate(null,$page);
        $scoreList['pager'] = $scorePaginate->getPagination();
        $scoreList['data'] = $scorePaginate->data;

        // 设置缓存
        Yii::app()->cache->set($cacheKey, [
            'pager' => $scoreList['pager'],
            'data' => $scoreList['data']
        ], 1800);

        return $scoreList;
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
        $criteria->limit = 30;
        $criteria->compare('user_id', '=' . $user_id);
        if($type=='add')
        {
            $criteria->compare('score', '>=0');
        }
        elseif($type=='reduce')
        {
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
            1=>'签到增加',
            2=>'连续签到2天增加',
            3=>'连续签到3天增加',
            4=>'连续签到3天以上增加',
            5=>'商品兑换',
            6=>'积分兑换',
        ];
        return $type_list[$type_id];
    }   
}
