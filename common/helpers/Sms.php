<?php

/**
 * 短信平台接口封装
 *
 * @author liukui<liujickson@gmail.com>
 */
class Sms
{

    /**
     * 短信发送接口
     * @param string $mobile 手机号码
     * @param type $name Description
     */
    public static function send($mobile, $content)
    {
        $config = Yii::app()->params['sms'];
        $header = [];
        $data = [
            'account' => $config['account'],
            'password' => $config['password'],
            'mobile' => $mobile,
            'content' => $content,
            'action' => 'send',
        ];
        $request = Requests::post($config['sendUrl'], $header, $data);
        if ($request->status_code) {
            $xml = simplexml_load_string($request->body);
            return ($xml->returnstatus == 'Success') ? true : false;
        }
        return false;
    }

    /**
     * 手机号码认证缓存KEY
     * @param integer $userId 用户ID
     * @return string 
     */
    public static function mobileValidateKey($userId)
    {
        return md5("mobile-validate-" . $userId);
    }

    /**
     * 手机号码绑定验证模板
     * @param string $code 验证码
     * @return string 
     */
    public static function mobileValidateTpl($code)
    {
        return "欢迎使用美品网，您的手机验证码是：" . $code . "。【美品网】";
    }

    /**
     * 手机随机验证码
     */
    public static function mobileRandCode()
    {
        return rand(1000, 9999);
    }

}
