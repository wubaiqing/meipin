<?php
/**
 * 用户登陆日志管理
 * @author wubaiqing<wubaiqing@vip.qq.com>
 * @copyright Copyright (c) 2013 今天值得买
 * @since 1.5
 */
class UserLoginLog extends ActiveRecord implements IArrayable
{
    /**
     * 表名
     * @return string
     */
    public function tableName()
    {
        return '{{meipin_user_login_log}}';
    }

    /**
     * 验证规则
     * @return array
     */
    public function rules()
    {
        return array(
            array('id, user_id, time, created_at, updated_at, opration', 'safe'),
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
            'time' => '登陆时间',
            'created_at' => '创建时间',
            'updated_at' => '更新时间',
            'opration' => '操作记录',
        );
    }

    /**
     * 设置当前用户登陆时间
     */
    public static function setLoginTime($userName)
    {
        $userId = User::getUserName($userName);
        $today = strtotime('today');
        $tormorrow = strtotime('+1 day 00:00:00') - 1;
        $userTime = UserLoginLog::model()->find(array(
            'condition' => 't.time >=:today And t.time <=:tomorrow And t.user_id =:user_id',
            'params' => array(':today' => $today, ':tomorrow' => $tormorrow, ':user_id' => $userId)
        ));

        if (empty($userTime)) {
            $now = time();
            $userLoginLog = new UserLoginLog();
            $userLoginLog->user_id = $userId;
            $userLoginLog->time = $now;
            $userLoginLog->save();
        }
    }

    /**
     * 当天登陆时间
     */
    public static function getTodayLoginTime($userId)
    {
        $userId = User::getUserName(Yii::app()->user->id);
        $getLoginLog = UserLoginLog::model()->find(array(
            'select' => 'time',
            'condition' => 't.user_id =:user_id',
            'limit' => '1',
            'order' => 't.id Desc',
            'params' => array(':user_id' => $userId)
        ));
        if (empty($getLoginLog)) {
            return '<span style="color:green;">请重新登陆</span>';
        } else {
            return date('H:i', $getLoginLog->time);
        }
    }

    /*
    *    插入操作记录
    */
    public static function addOperation($operation)
    {
        $userId = User::getUserName(Yii::app()->user->id);
        if (!empty($operation)) 
        {
            $now = time();
            $userLoginLog = new UserLoginLog(); 
            $userLoginLog->user_id = $userId;
            $userLoginLog->time = $now;
            $userLoginLog->operation = $operation;
            $userLoginLog->save();
        }
    }

}
