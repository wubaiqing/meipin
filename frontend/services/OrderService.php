<?php

/**
 * 订单服务操作类
 *
 * @author liukui<liujickson@gmail.com>
 */
class OrderService
{

    public static function pay($id, $user_id)
    {
        $url = "/";
        if (!preg_match('/^\d+$/', $id)) {
            return CommonHelper::getDataResult(false, ['message' => '订单号非法', 'url' => $url]);
        }
        $order = Order::findByUserId($id, $user_id);
        if (empty($order)) {
            return CommonHelper::getDataResult(false, ['message' => '订单不存在', 'url' => $url]);
        }
        return self::alipayapi($order->order_id, "測試商品名稱", $order->pay_price, Yii::app()->createUrl("exchange/aaa"), '測試訂單');
    }

    /**
     * 支付所需参数
     * @param fixed $orderId 订单号
     * @param string $orderName 订单名称
     * @param decimal $payPrice 支付金额
     * @param string $goodsUrl 商品地址
     * @param string $remark 备注
     */
    protected static function alipayapi($orderId, $orderName, $payPrice, $goodsUrl, $remark)
    {
//        Yii::import('common.extensions.alipayapi.*');
        include_once Yii::app()->basePath."/../common/extensions/alipayapi/alipay_core.function.php";
        include_once Yii::app()->basePath."/../common/extensions/alipayapi/alipay_md5.function.php";
        include_once Yii::app()->basePath."/../common/extensions/alipayapi/alipay_notify.class.php";
        include_once Yii::app()->basePath."/../common/extensions/alipayapi/alipay_submit.class.php";
        //支付类型
        $payment_type = "1";
        //必填，不能修改
        //服务器异步通知页面路径
//        $notify_url = "http://www.meipin.com/alipay/notify_url.php";
        $notify_url = Yii::app()->createUrl("order/notify");
        //需http://格式的完整路径，不能加?id=123这类自定义参数
        //页面跳转同步通知页面路径
        $return_url = Yii::app()->createUrl("order/return");
        //需http://格式的完整路径，不能加?id=123这类自定义参数，不能写成http://localhost/
        //卖家支付宝帐户
        $seller_email = Yii::app()->params['alipay']['email'];
        //必填
        //商户订单号
        $out_trade_no = $orderId;
        //商户网站订单系统中唯一订单号，必填
        //订单名称
        $subject = $orderName;
        //必填
        //付款金额
        $total_fee = $payPrice;
        //必填
        //订单描述
        $body = $remark;
        //商品展示地址
        $show_url = $goodsUrl;
        //需以http://开头的完整路径，例如：http://www.xxx.com/myorder.html
        //防钓鱼时间戳
        $anti_phishing_key = "";
        //若要使用请调用类文件submit中的query_timestamp函数
        //客户端的IP地址
        $exter_invoke_ip = Yii::app()->request->getHostInfo();
        //非局域网的外网IP地址，如：221.0.0.1
        //构造要请求的参数数组，无需改动
        $alipay_config = self::getAlipayConfig();
        $parameter = array(
            "service" => "create_direct_pay_by_user",
            "partner" => trim($alipay_config['partner']),
            "payment_type" => $payment_type,
            "notify_url" => $notify_url,
            "return_url" => $return_url,
            "seller_email" => $seller_email,
            "out_trade_no" => $out_trade_no,
            "subject" => $subject,
            "total_fee" => $total_fee,
            "body" => $body,
            "show_url" => $show_url,
            "anti_phishing_key" => $anti_phishing_key,
            "exter_invoke_ip" => $exter_invoke_ip,
            "_input_charset" => trim(strtolower($alipay_config['input_charset']))
        );
        //建立请求
        $alipaySubmit = new AlipaySubmit($alipay_config);
        $html_text = $alipaySubmit->buildRequestForm($parameter, "get", "正在跳转到支付页面……");
        return $html_text;
    }

    /**
     * 支付寶配置信息
     */
    protected static function getAlipayConfig()
    {
        //↓↓↓↓↓↓↓↓↓↓请在这里配置您的基本信息↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓
        //合作身份者id，以2088开头的16位纯数字
        $alipay_config['partner'] = Yii::app()->params['alipay']['id'];
        //安全检验码，以数字和字母组成的32位字符
        $alipay_config['key'] = Yii::app()->params['alipay']['key'];
        //↑↑↑↑↑↑↑↑↑↑请在这里配置您的基本信息↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑
        $alipay_config['sign_type'] = strtoupper('MD5');
        //字符编码格式 目前支持 gbk 或 utf-8
        $alipay_config['input_charset'] = strtolower('utf-8');
        //ca证书路径地址，用于curl中ssl校验
        //请保证cacert.pem文件在当前文件夹目录中
        $alipay_config['cacert'] = getcwd() . '\\cacert.pem';

        //访问模式,根据自己的服务器是否支持ssl访问，若支持请选择https；若不支持请选择http
        $alipay_config['transport'] = 'http';
        return $alipay_config;
    }

}
