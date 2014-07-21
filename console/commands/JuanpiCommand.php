<?php
/**
 * 卷皮淘宝U站抓取
 * @author wubaiqing <wubaiqing@vip.qq.com>
 * @copyright Copyright (c) 2014 美品网
 * @since 1.0
 */

/**
 * Chrome source link ： view-source:http://juanpi.uz.taobao.com/
 *
 * 使用'simple html dom'PHP扩展
 * http://simplehtmldom.sourceforge.net/
 *
 * 卷皮淘宝U站URL
 * http://juanpi.uz.taobao.com/
 *
 * 脚本采集命令：php yiic juanpi
 *
 * 计划任务：每天8点、9点
 *
 * 创建日期：2014-7-18
 *
 * @author wubaiqing <wubaiqing@55tuan.com>
 */
include Yii::getPathOfAlias('common.extensions') . '/simple_html_dom.php';

class JuanpiCommand extends CConsoleCommand
{
    /**
     * 抓取
     */
    public static $url = array(
        '1' => 'http://juanpi.uz.taobao.com/?m=index&cat=nvzhuang&page=',
        '4' => 'http://juanpi.uz.taobao.com/?m=index&cat=nanzhuang&page=',
        '5' => 'http://juanpi.uz.taobao.com/?m=index&cat=jujia&page=',
        '6' => 'http://juanpi.uz.taobao.com/?m=index&cat=muying&page=',
        '9' => 'http://juanpi.uz.taobao.com/?m=index&cat=meishi&page=',
        '10' => 'http://juanpi.uz.taobao.com/?m=index&cat=shuma&page=',
        '11' => 'http://juanpi.uz.taobao.com/?m=index&cat=meizhuang&page=',
        '12' => 'http://juanpi.uz.taobao.com/?m=index&cat=wenti&page=',
        '1000' => 'http://juanpi.uz.taobao.com/?m=index&cat=xiebaopeishi&page=',
    );

    /**
     * 开启多进程更新商品数据
     */
    public function actionIndex()
    {
        foreach (self::$url as $catId => $url) {
            FetchHelpers::run("juanpi update", $catId, $url);
        }
    }

    /**
     * 脚本默认执行函数
     *
     * 请求URL脚本超时时间20秒
     *
     * 逻辑
     * 1. 获取所有U站分类链接
     * 2. 根据分类链接获取当前U站6页的数据
     */
    public function actionUpdate($catId, $url)
    {
        for ($page = 1; $page <= 6; $page++) {
            $fetchUrl = $url . $page;
            FetchHelpers::trace('正在抓取URL：' . $fetchUrl);
            $html = file_get_html($fetchUrl, false, stream_context_create([
                'http' => [
                    'method' => "GET",
                    'timeout' => 20,
                ]
            ]));

            foreach ($html->find('.main-good') as $dealad) {
                $data = self::handleData($dealad);
                unset($dealad);
                FetchHelpers::update($catId, $data);
            }
        }
    }

    /**
     * 处理淘宝客数据
     * @param  object $dealad 当前
     * @return array
     */
    public static function handleData($dealad)
    {
        $data = [];

        // 淘宝URL
        $data['url'] = $dealad->find('a', 0)->href;

        // 淘宝ID
        $data['taobaoId'] = FetchHelpers::getInt(substr($data['url'], -13));

        // 商品标题
        $data['title'] = $dealad->find('h3', 0)->find('a', 0)->plaintext;

        // 商品价格
        $data['price'] = FetchHelpers::getInt($dealad->find('h4', 0)->find('span', 0)->plaintext);

        // 商品原始价格
        $data['origin_price'] = FetchHelpers::getInt($dealad->find('h4', 0)->find('span', 2)->plaintext);

        // 商品开始结束时间
        $H = date('H');
        if ($H >= '16') {
            // 开始结束时间
            $data['startTime'] = strtotime('+ 1 day 00:00:00');
            $data['endTime'] = strtotime('+ 5 day 23:59:59');
        } else {
            // 开始结束时间
            $data['startTime'] = strtotime(date('Y-m-d'));
            $data['endTime'] = strtotime('+ 5 day 23:59:59');
        }

        return $data;
    }
}
