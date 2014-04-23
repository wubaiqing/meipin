<?php
/**
 * 商品管理
 * @author wubaiqing<wubaiqing@vip.qq.com>
 * @copyright Copyright (c) 2013 今天值得买
 * @since 1.5
 */
class User extends ActiveRecord implements IArrayable
{
	/**
	 * 表名
	 * @return string
	 */
    public function tableName()
    {
        return '{{meipin_users}}';
    }

    /**
     * 验证规则
     * @return array
     */
    public function rules()
    {
        return array(
            array('id, username, password, salt, created_at, updated_at', 'safe'),
            array('verifyCode', 'captcha', 'allowEmpty'=>!extension_loaded('gd') ,'on'=>'register'),
            array('verifyCode', 'activeCaptcha', 'on'=>'register')
        );
    }



}

