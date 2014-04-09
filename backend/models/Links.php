<?php
/**
 * 书签管理
 * @author wubaiqing<wubaiqing@vip.qq.com>
 * @copyright Copyright (c) 2013 今天值得买
 * @since 1.5
 */
class Links extends ActiveRecord implements IArrayable
{
    /**
     * 表名
     * @return string
     */
    public function tableName()
    {
        return '{{links}}';
    }

    /**
     * 验证规则
     * @return array
     */
    public function rules()
    {
        return array(
            array('image_url, url', 'required'),
            array('id, image_url, url, created_at, updated_at', 'safe'),
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
            'image_url' => '图片地址',
            'url' => '链接地址',
        );
    }

}