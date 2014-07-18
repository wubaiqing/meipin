<?php
/**
 * 折800淘宝U站抓取
 * @author wubaiqing <wubaiqing@vip.qq.com>
 * @copyright Copyright (c) 2014 美品网
 * @since 1.0
 */

/**
 * 折800淘宝U站抓取
 * Chrome source link ： view-source:http://zhe800.uz.taobao.com/
 *
 * 使用simple html domPHP扩展
 * link ： http://simplehtmldom.sourceforge.net/
 *
 * 折800淘宝U站URL
 * http://zhe800.uz.taobao.com/
 *
 * 执行命令：php yiic zhe
 *
 * @author wubaiqing <wubaiqing@55tuan.com>
 */
include Yii::getPathOfAlias('common.extensions') . '/simple_html_dom.php';

class ZheCommand extends CConsoleCommand
{
	/**
	 *
	 */
	public function actionIndex()
	{
		$html = file_get_html('http://zhe800.uz.taobao.com/');
		foreach ($html->find('.dealinfo') as $dealad) {
			$data = self::handleData($dealad);
		}
	}

	public static function handleData($dealad)
	{
		$data = [];

		// 淘宝URL
		$data['url'] = $dealad->find('p', 0)->find('a', 0)->href;

		// 淘宝ID
		$data['taobaoId'] = intval($data['url']);

		// 商品标题
		$data['title'] = self::covert($dealad->find('h2', 0)->find('a', 1)->plaintext);

		// 分类名称
		$data['catName'] = str_replace(['【', '】'], '', self::covert($dealad->find('h2', 0)->find('strong', 0)->plaintext));

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

		var_dump($data);
		exit;

		return $data;

	}

	/**
	 * 字符串转换
	 */
	public static function covert($str)
	{
		return mb_convert_encoding($str, 'UTF-8', 'GBK');

	}



}

