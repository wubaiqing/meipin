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
            //return $name;
        }

        
        //$scoreAll = self::model()->findAll();
        $criteria = new CDbCriteria;
        $criteria->select = '*';
        $criteria->order = 'id DESC';
        $criteria->limit = 300;
        $criteria->compare('user_id', '=' . $user_id);
        if($type=='add')
        {
        	$criteria->compare('score', '>=0');
        }
        elseif($type=='reduce')
        {
        	$criteria->compare('score', '<0');
        }
		//var_dump($criteria);exit;
		$scores = Score::model()->findAll($criteria);
		//var_dump($scores);exit;
		$pagination = $this->paginate();

        $data['data'] = $pagination->data;
        $data['pager'] = $pagination->getPagination();
        
        Yii::app()->cache->set($cacheKey, $this, 86400);

        return $data;
    }
}
