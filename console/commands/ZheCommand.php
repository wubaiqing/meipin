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
 * 使用'simple html dom'PHP扩展
 * http://simplehtmldom.sourceforge.net/
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
		$html = file_get_html('http://zhe800.uz.taobao.com/', false, [
			'http' => [
				'method' => "GET",
				'timeout' => 20,
			]
		]);
		foreach ($html->find('.dealinfo') as $dealad) {
			$data = self::handleData($dealad);
			unset($dealad);
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
		$data['taobaoId'] = self::getInt(substr($data['url'], -13));

		// 商品标题
		$data['title'] = self::covert($dealad->find('h2', 0)->find('a', 1)->plaintext);

		// 分类名称
		$data['catName'] = str_replace(['【', '】'], '', self::covert($dealad->find('h2', 0)->find('strong', 0)->plaintext));

		// 商品价格
		$data['price'] = self::getInt($dealad->find('h4', 0)->find('span', 0)->plaintext);

		// 商品原始价格
		$data['origin_price'] = self::getInt($dealad->find('h4', 0)->find('span', 1)->find('i', 0)->plaintext);

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

	/**
	 * 字符串转换
	 * @param string $string 字符串
	 * @return 转换编UTF-8码字符串
	 */
	public static function covert($string)
	{
		return mb_convert_encoding($string, 'UTF-8', 'GBK');
	}

	/**
	 * 从字符串中获取整形数字
	 * @param $string 字符串
	 * @return mixed 字符串中整形结果
	 */
	public static function getInt($string)
	{
		return preg_replace('/([^0-9.]+)/','',trim($string));
	}

}

