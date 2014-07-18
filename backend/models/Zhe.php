<?php
/**
 * API接口管理
 * @author wubaiqing<wubaiqing@vip.qq.com>
 * @copyright Copyright (c) 2013 今天值得买
 * @since 1.5
 */
class Zhe
{
    public function __construct() {}

    /**
     * 推送数据
     */
    public $traceEcho = true;

    /**
     * 折800抓取URL
     */
    public static $url = array(
        '1' => 'http://zhe800.uz.taobao.com/list.php?tag_id=2&page=',
        '4' => 'http://zhe800.uz.taobao.com/list.php?tag_id=11&page=',
        '5' => 'http://zhe800.uz.taobao.com/list.php?tag_id=7&page=',
        '6' => 'http://zhe800.uz.taobao.com/list.php?tag_id=8&page=',
        '7' => 'http://zhe800.uz.taobao.com/list.php?tag_id=4&page=',
        '8' => 'http://zhe800.uz.taobao.com/list.php?tag_id=12&page=',
        '9' => 'http://zhe800.uz.taobao.com/list.php?tag_id=6&page=',
        '10' => 'http://zhe800.uz.taobao.com/list.php?tag_id=5&page=',
        '11' => 'http://zhe800.uz.taobao.com/list.php?tag_id=3&page=',
    );

    public static function runToBackground($method, $cateId, $url)
    {
        $yiic = __DIR__ . "/../../yiic";
        $cmd = "php $yiic zhe $method --cateId='{$cateId}' --url='{$url}'";
        $logfile = "/tmp/$method.log";
        exec($cmd . " >> {$logfile} &");
    }

    /**
     * 更新商品数据
     * @param integer $cateId 分类ID
     * @param string  $url    URL地址
     */
    public function updateZheGoods($cateId, $url)
    {
        for ($page = 1; $page <= 6; $page++) {
            $curUrl = $url . $page;
            $this->trace('正在抓取分类ID为:' . $cateId. '的。当前第：' . $page . '页，URL：' . $curUrl);
            $html = file_get_contents($url);
            $data = $this->getZhe800Data($html);
            self::save($cateId, $data);
        }
    }

    /**
     * 保存商品
     * @param integer $cateId 分类ID
     * @param array   $data   网页抓取数据
     */
    public static function save($cateId, $data)
    {
        foreach ($data as $key => $val) {
            $goods = Goods::model()->find(array(
                'select' => 'tb_id, end_time',
                'condition' => 'tb_id =:tb_id',
                'params' => array(':tb_id' => $val['tbId'])
            ));

            if (empty($goods)) {
                $goods = new Goods();
            }
            $val['cat_id'] = $cateId;
            self::addGoods($goods, $val);
        }
    }

    /**
     * 添加商品
     * @param object $goods 商品对象
     * @param array  $data  商品抓取数据
     */
    public static function addGoods($goods, $data)
    {
        if ($goods->end_time >= time()) {
            return false;
        }

        $goods->cat_id = $data['cat_id'];
        $goods->url = $data['url'];
        $goods->title = mb_convert_encoding($data['title'], 'UTF-8', 'GBK');
        $goods->picture = $data['image'];
        $goods->price = $data['price'];
        $goods->origin_price = $data['origin_price'];
        $goods->start_time = date('Y-m-d H:i:s', $data['startTime']);
        $goods->end_time = date('Y-m-d H:i:s', $data['endTime']);
        $goods->relation_website = 6;
        $goods->goods_type = 0;
        $goods->user_id = 5;
        $goods->tb_id = $data['tbId'];
        $goods->is_zhe800 = 1;
        $goods->save();
	    var_dump($goods->getErrors());
	    exit;

    }

    /**
     * 折800数据
     * @param string $zhe800html 折800页面数据
     */
    public static function getZhe800Data($zhe800html)
    {
        // 匹配商品
        preg_match_all('/<h2>(.*)<\/h2>/isU', $zhe800html, $html);

        // 时间
        preg_match_all('/<h5>(.*)<span>(.*)<\/span>(.*)<\/h5>/isU', $zhe800html, $time);

        // 商品价格
        preg_match_all('/<em><b>(.*)<\/b>(.*)<\/em>/isU', $zhe800html, $price);

        // 商品图片
        preg_match_all('/<img src="(.*)"\/>/isU', $zhe800html, $images);

        // 商品原价
        preg_match_all('/<span>(.*)<i>(.*)<\/i>(.*)<\/span>/isU', $zhe800html, $originPrice);

        // 统计商品数量
        $html = $html['0'];
        $count = count($html);

        unset($html['0']);
        unset($html[$count-1]);

        $H = date('H');
        if ($H >= '16') {
            // 开始结束时间
            $startTime = strtotime('+ 1 day 00:00:00');
            $endTime = strtotime('+ 5 day 23:59:59');
        } else {
            // 开始结束时间
            $startTime = strtotime(date('Y-m-d'));
            $endTime = strtotime('+ 5 day 23:59:59');
        }

        $zhe800UWebSite = array();
        foreach ($html as $key => $val) {
            // 分类
            //
            preg_match('/<strong>(.*)<\/strong>/isU', $val, $cat);

            // 网站URL
            preg_match('/<a\starget="_blank"\shref="http:\/\/(.*)">(.*)<\/a>/isU', $val, $array);

            // 淘宝ID
            preg_match('/<a\starget="_blank"\shref="http:\/\/(.*)id=(.*)">(.*)<\/a>/isU', $val, $taobao);

            // 分类名称
            $cat = iconv('GBK//IGNORE', 'UTF-8', mb_substr(trim(strip_tags($cat['1'])),1 , -1, 'GBK'));

            if (!isset($array['1'])) {
                continue;
            }
            $curTime = mb_convert_encoding($time['2'][$key - 1], 'UTF-8', 'GBK');
            $curTime = substr($curTime, 20);
            if ($curTime != '00:00') {
                $startTime = strtotime('+ 0 day '.$curTime.':00');
            }

            // URL
            $url = 'http://' . $array['1'];

            // 标题
            $title = mb_convert_encoding($array['2'], 'UTF-8', 'GBK');

            if (!isset($price['0'][$key-1])) {
                continue;
            }
            // 现价
            $curPrice = strip_tags($price['2'][$key-1]);

            unset($originPrice['2']['0']);
            $getOriginPrices = array_values($originPrice['2']);

            // 原价
            $curOriginPrice = substr($getOriginPrices[$key-1], 2);

            // 图片
            $image = $images['1'][$key-1];

            $tbId = $taobao['2'];
            if (strpos($taobao['2'], '&')) {
                $tbIds = explode('&', $tbId);
                $tbId = $tbIds['0'];
            }

            // 合并数组
            $zhe800UWebSite[] = array(
                'title' => $title,
                'origin_price' => $curPrice,
                'price' => $curPrice,
                'origin_price' => $curOriginPrice,
                'image' => $image,
                'url' => $url,
                'cat' => $cat,
                'startTime' => $startTime,
                'endTime' => $endTime,
                'tbId' => $tbId,
            );
        }

        return  $zhe800UWebSite;
    }

}
