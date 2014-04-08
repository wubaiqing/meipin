<?php
class Banner extends ActiveRecord implements IArrayable
{
    /**
     * 表名
     * @return string
     */
    public function tableName()
    {
        return '{{banner}}';
    }

    /**
     * 验证规则
     * @return array
     */
    public function rules()
    {
        return array(
            array('url, picture, width, height, color, created_at, updated_at', 'safe'),
        );
    }

}
