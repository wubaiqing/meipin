<?php

/**
 * 用户管理
 * @author wubaiqing<wubaiqing@vip.qq.com>
 * @copyright Copyright (c) 2014 美品
 * @since 1.0
 */
class FeedBack extends ActiveRecord implements IArrayable
{
    public $qq;
    public $advise;
    public $email;
    public $updated_at;//非数据库的字段，但是在view中需要用到  
    public $created_at;//非数据库的字段，但是在view中需要用到  
    /**
     * 验证规则
     * @return array
    */
    public function tableName()
    {
        return '{{meipin_feedback}}';
    }

        //验证表单域  
    public function rules() {  
        return array(  
            array("qq","required","message"=>"QQ不能为空"),  
   
            array("advise","required","message"=>"不能为空哦"),  
               
            //验证邮箱  
            array("email","email","allowEmpty"=>true,"message"=>"邮箱格式不正确"),  
        );  
    }  
    //验证爱好  
   function checkHobby(){  
        $this->hobby;  
        $len= strlen($this->hobby);  
        if($len<3){  
            $this->addError("hobby","爱好至少为2个以上");  
        }  
    } 
}