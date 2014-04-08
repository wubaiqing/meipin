<?php
/**
 * 分类管理
 * @author wubaiqing<wubaiqing@vip.qq.com>
 * @copyright Copyright (c) 2013 今天值得买
 * @since 1.5
 */
class BlackList extends ActiveRecord implements IArrayable
{
    /**
     * 表名
     * @return string
     */
    public function tableName()
    {
        return '{{blacklist}}';
    }

    /**
     * 验证规则
     * @return array
     */
    public function rules()
    {
        return array(
            array('tb_id, title', 'required'),
            array('tb_id, title', 'safe'),
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
            'tb_id' => '淘宝ID',
            'title' => '标题',
        );
    }

    /**
     * 添加黑名单
     */
    public static function addBlackList($tbId, $title)
    {
        $blackList = new BlackList();
        $blackList->tb_id = $tbId;
        $blackList->title = $title;

        return $blackList->save();
    }

}
