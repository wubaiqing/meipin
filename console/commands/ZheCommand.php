<?php
/**
 * 折800淘宝U站抓取
 * @author wubaiqing <wubaiqing@vip.qq.com>
 * @copyright Copyright (c) 2014 美品网
 * @since 1.0
 */

/**
 * Chrome source link ： view-source:http://zhe800.uz.taobao.com/
 *
 * 使用'simple html dom'PHP扩展
 * http://simplehtmldom.sourceforge.net/
 *
 * 折800淘宝U站URL
 * http://zhe800.uz.taobao.com/
 *
 * 脚本采集命令：php yiic zhe
 *
 * 计划任务：每天8点、9点
 *
 * 创建日期：2014-7-18
 *
 * @author wubaiqing <wubaiqing@55tuan.com>
 */
include Yii::getPathOfAlias('common.extensions') . '/simple_html_dom.php';

class ZheCommand extends CConsoleCommand
{
	/**
	 * 脚本默认执行函数
	 *
	 * 请求URL脚本超时时间20秒
	 *
	 * 逻辑
	 * 1. 获取所有U站分类链接
	 * 2. 根据分类链接获取当前U站10页的数据
	 */
	public function actionIndex()
	{
		$html = file_get_html('http://zhe800.uz.taobao.com/', false, stream_context_create([
			'http' => [
				'method' => "GET",
				'timeout' => 20,
			]
		]));
		foreach ($html->find('.dealinfo') as $dealad) {
			$data = self::handleData($dealad);
			unset($dealad);
			FetchHelpers::update(1, $data);
		}
	}

	/**
	 * 处理淘宝客数据
	 * @param object $dealad 当前
	 * @return array
	 */
	public static function handleData($dealad)
	{
		$data = [];

		// 淘宝URL
		$data['url'] = $dealad->find('p', 0)->find('a', 0)->href;

		// 淘宝ID
		$data['taobaoId'] = FetchHelpers::getInt(substr($data['url'], -13));

		// 商品标题
		$data['title'] = FetchHelpers::covert($dealad->find('h2', 0)->find('a', 1)->plaintext);

		// 分类名称
		$data['catName'] = str_replace(['【', '】'], '', FetchHelpers::covert($dealad->find('h2', 0)->find('strong', 0)->plaintext));

		// 商品价格
		$data['price'] = FetchHelpers::getInt($dealad->find('h4', 0)->find('span', 0)->plaintext);

		// 商品原始价格
		$data['origin_price'] = FetchHelpers::getInt($dealad->find('h4', 0)->find('span', 1)->find('i', 0)->plaintext);

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

