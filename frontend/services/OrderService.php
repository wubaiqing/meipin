<?php

/**
 * 订单服务操作类
 *
 * @author liukui<liujickson@gmail.com>
 */
class OrderService
{

    /**
     * 加载文件
     */
    protected static function load()
    {
        include_once Yii::app()->basePath . "/../common/extensions/alipayapi/alipay_core.function.php";
        include_once Yii::app()->basePath . "/../common/extensions/alipayapi/alipay_md5.function.php";
        include_once Yii::app()->basePath . "/../common/extensions/alipayapi/alipay_notify.class.php";
        include_once Yii::app()->basePath . "/../common/extensions/alipayapi/alipay_submit.class.php";
    }

    public static function pay($id, $user_id)
    {
        $maxTimeout = Yii::app()->params['payTimeout'];
        //echo $maxTimeout;
        //die;
        $url = "/";
        if (!preg_match('/^\d+$/', $id)) {
            return CommonHelper::getDataResult(false, ['message' => '订单号非法', 'url' => $url]);
        }
        $order = Order::findByUserId($id, $user_id);
        //$order = Order::model()->findByPk($id, 'user_id=:user_id',array(':user_id' => $user_id));
        if (empty($order)) {
            return CommonHelper::getDataResult(false, ['message' => '订单不存在', 'url' => $url]);
        }
        $goodsInfo = self::loadGoods($order);
        if (empty($goodsInfo)) {
            return CommonHelper::getDataResult(false, ['message' => '商品信息不正确，请重新下单后再支付', 'url' => $url]);
        }
        /* 
        //不用再次判断积分不足了，下了订单之前已经判断了
        $user = User::model()->findByPk($order->user_id);
        if ($user->score < $order->integral) {
            return CommonHelper::getDataResult(false, ['message' => "你的积分不足以进行此次购买", 'url' => $url]);
        }*/
        //支付超时
        if (($order->created_at + $maxTimeout) < time()) {
	        $order->pay_status = 1;
	        $order->update(['pay_status']);
            return CommonHelper::getDataResult(false, ['message' => '付款时间已经超时，不能再进行付款', 'url' => Yii::app()->createUrl("order/list")]);
        }
        $html = self::alipayapi($order->order_id, $goodsInfo['name'], $order->pay_price, $goodsInfo['url'], $goodsInfo['remark']);
        return CommonHelper::getDataResult(true, ['message' => $html]);
    }

    /**
     * 加载商品信息
     * @param Order $order 订单实体
     * @return array 
     */
    protected static function loadGoods(Order $order)
    {
        $result = [];
        if ($order->order_type == 1) {
            $goods = Exchange::model()->findByPk($order->goods_id);
            $result['url'] = Yii::app()->createAbsoluteUrl('exchange/exchangeIndex', ['id' => Des::encrypt($goods->id)]);
            $result['name'] = $goods->name;
            $result['remark'] = '积分加钱兑换商品';
        }
        return $result;
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
        self::load();
        //支付类型
        $payment_type = "1";
        //必填，不能修改
        //服务器异步通知页面路径
//        $notify_url = "http://www.meipin.com/alipay/notify_url.php";
        $notify_url = Yii::app()->createAbsoluteUrl("order/notify");
        //需http://格式的完整路径，不能加?id=123这类自定义参数
        //页面跳转同步通知页面路径
        $return_url = Yii::app()->createAbsoluteUrl("order/result");
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

    public static function notify()
    {
        try {
            Yii::log('通知init,'.  json_encode($_POST), CLogger::LEVEL_INFO,'application.notify');
            self::load();
            $alipay_config = self::getAlipayConfig();
            $alipayNotify = new AlipayNotify($alipay_config);
            $verify_result = $alipayNotify->verifyNotify();
            if ($verify_result) {//验证成功
                /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
                //请在这里加上商户的业务逻辑程序代
                //——请根据您的业务逻辑来编写程序（以下代码仅作参考）——
                //获取支付宝的通知返回参数，可参考技术文档中服务器异步通知参数列表
                //商户订单号
                $out_trade_no = $_POST['out_trade_no'];
                //支付宝交易号
                $trade_no = $_POST['trade_no'];
                //交易状态
                $trade_status = $_POST['trade_status'];
                $notify_time = $_POST['notify_time'];

                if ($_POST['trade_status'] == 'TRADE_FINISHED') {
                    //判断该笔订单是否在商户网站中已经做过处理
                    //如果没有做过处理，根据订单号（out_trade_no）在商户网站的订单系统中查到该笔订单的详细，并执行商户的业务程序
                    //如果有做过处理，不执行商户的业务程序
                    //注意：
                    //该种交易状态只在两种情况下出现
                    //1、开通了普通即时到账，买家付款成功后。
                    //2、开通了高级即时到账，从该笔交易成功时间算起，过了签约时的可退款时限（如：三个月以内可退款、一年以内可退款等）后。
                    //调试用，写文本函数记录程序运行情况是否正常
                    //logResult("这里写入想要调试的代码变量值，或其他运行的结果记录");
                } else if ($_POST['trade_status'] == 'TRADE_SUCCESS') {
                    //判断该笔订单是否在商户网站中已经做过处理
                    //如果没有做过处理，根据订单号（out_trade_no）在商户网站的订单系统中查到该笔订单的详细，并执行商户的业务程序
                    //如果有做过处理，不执行商户的业务程序
                    //注意：
                    //该种交易状态只在一种情况下出现——开通了高级即时到账，买家付款成功后。
                    //调试用，写文本函数记录程序运行情况是否正常
                    //logResult("这里写入想要调试的代码变量值，或其他运行的结果记录");
                    //执行兑换
                    $transaction = Yii::app()->db->beginTransaction();
                    try {
                        $order = Order::model()->findByAttributes(['order_id' => $out_trade_no]);
                        $order->pay_time = strtotime($notify_time);
                        $order->pay_status = 4;
                        $order->update(['pay_time', 'pay_status']);

//                    Order::model()->updateByPk(['order_id'=>$out_trade_no], [
//                        'pay_time' => strtotime($notify_time),
//                        'pay_status' => 4
//                    ]);
                        $goods = Exchange::findByGoodsId($order->goods_id);

                        //更新状态
                        $exchangeLog = ExchangeLog::model()->find('order_id=:order_id', [':order_id' => $order->order_id]);
                        $exchangeLog->pay_status = 1;
                        $exchangeLog->update(['pay_status']);

                        //清楚订单列表缓存
                        ExchangeLog::deleteWelfareCache($order->user_id, 1, 1);
                        $transaction->commit();
                    } catch (\Exception $ex) {
                        Yii::log('通知成功,'.  json_encode($_POST), CLogger::LEVEL_ERROR,'application.notify');
                        $transaction->rollback();
                        echo "fail";
                        Yii::app()->end();
                    }
                }
                Yii::log('通知成功,'.  json_encode($_POST), CLogger::LEVEL_INFO,'application.notify');
                //——请根据您的业务逻辑来编写程序（以上代码仅作参考）——
                echo "success";  //请不要修改或删除
                /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
            } else {
                Yii::log('通知失败,'.  json_encode($_POST), CLogger::LEVEL_INFO,'application.notify');
                //验证失败
                echo "fail";
                //调试用，写文本函数记录程序运行情况是否正常
                //logResult("这里写入想要调试的代码变量值，或其他运行的结果记录");
            }
        } catch (\Exception $ex) {
            Yii::log(json_encode($_POST).$ex->getTraceAsString(), CLogger::LEVEL_ERROR,'application.notify');
            echo "fail";
        }
    }

    public static function result()
    {
        try {
            Yii::log('支付完成init,'.  json_encode($_GET), CLogger::LEVEL_INFO,'application.result');
            self::load();
            $alipay_config = self::getAlipayConfig();
            //计算得出通知验证结果
            $alipayNotify = new AlipayNotify($alipay_config);
            $verify_result = $alipayNotify->verifyReturn();
            if ($verify_result) {//验证成功
                /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
                //请在这里加上商户的业务逻辑程序代码
                //——请根据您的业务逻辑来编写程序（以下代码仅作参考）——
                //获取支付宝的通知返回参数，可参考技术文档中页面跳转同步通知参数列表
                //商户订单号
                $out_trade_no = $_GET['out_trade_no'];
                //支付宝交易号
                $trade_no = $_GET['trade_no'];
                //交易状态
                $trade_status = $_GET['trade_status'];
                if ($_GET['trade_status'] == 'TRADE_FINISHED' || $_GET['trade_status'] == 'TRADE_SUCCESS') {
                    //判断该笔订单是否在商户网站中已经做过处理
                    //如果没有做过处理，根据订单号（out_trade_no）在商户网站的订单系统中查到该笔订单的详细，并执行商户的业务程序
                    //如果有做过处理，不执行商户的业务程序
                    $order_array = array();
                    if (preg_match("/^\d+$/", $out_trade_no)) 
                    {
                        $order_array['order_id'] =  $out_trade_no;
                        $order = Order::model()->findByAttributes($order_array);
	                    if ($order->pay_status != 4) {
		                    $order->pay_time = time();
		                    $order->pay_status = 4;
		                    $order->update(['pay_time', 'pay_status']);
		                    $goods = Exchange::findByGoodsId($order->goods_id);
		                    $exchangeLog = ExchangeLog::model()->find('order_id=:order_id', [':order_id' => $order->order_id]);
		                    $exchangeLog->pay_status = 1;
		                    $exchangeLog->update(['pay_status']);
		                    ExchangeLog::deleteWelfareCache($order->user_id, 1, 1);
	                    }

                        if (!empty($order)) {
                            ExchangeLog::deleteWelfareCache($order->user_id, 1, 1);
                        }
                    }
                    Yii::log('付款成功,'.  json_encode($_GET), CLogger::LEVEL_INFO,'application.result');
                    return CommonHelper::getDataResult(true, ['message' => '付款成功！']);
                } else {
                    Yii::log('付款失败,'.  json_encode($_GET), CLogger::LEVEL_INFO,'application.result');
                    return CommonHelper::getDataResult(false, ['message' => '付款失败！']);
                }

                //——请根据您的业务逻辑来编写程序（以上代码仅作参考）——
                /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
            } else {
                //如要调试，请看alipay_notify.php页面的verifyReturn函数
//            echo "验证失败";
                Yii::log('付款验证失败，请勿重复操作！', CLogger::LEVEL_INFO,'application.result');
                return CommonHelper::getDataResult(false, ['message' => '付款验证失败，请勿重复操作！']);
            }
        } catch (\Exception $ex) {
            Yii::log($ex->getTraceAsString(), CLogger::LEVEL_ERROR,'application.result');
            return CommonHelper::getDataResult(false, ['message' => '付款失败,请重试']);
        }
    }

}
