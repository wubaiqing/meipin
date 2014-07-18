<?php
/**
 * 采集淘宝U站数据处理
 * @author wubaiqing <wubaiqing@vip.qq.com>
 * @copyright Copyright (c) 2014 美品网
 * @since 1.0
 */

/**
 * 处理淘宝U站数据
 *
 * 包含：
 * 1. 字符串转换
 * 2. 获取淘宝链接
 * 3. 获取淘宝ID
 * 4. 保存商品
 * 5. ........
 *
 * @author wubaiqing <wubaiqing@55tuan.com>
 */
class FetchHelpers
{
	/**
	 * 输出Log日志
	 * @param string $message 日志信息
	 * @param bool $time 是否记录时间
	 * @param bool $n 是否换行
	 * @param bool $echo 是否输出
	 * @return string
	 */
	public static function trace($message, $time = true, $n = true, $echo = true)
	{
		$log = "";
		if ($time == true) {
			$log = date('Y/m/d H:i:s') . " ";
		}

		$log .= $message;
		if ($n == true) {
			$log .= "\n";
		}

		if ($echo == false) {
			return $log;
		}

		echo $log;
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

	/**
	 * 添加商品数据
	 * @param integer $catId 分类ID
	 * @param array $U 淘宝客采集过来的数据
	 */
	public static function update($catId, $U)
	{
		$goods = Goods::model()->find(array(
			'select' => 'tb_id, end_time',
			'condition' => 'tb_id =:tb_id',
			'params' => array(':tb_id' => $data['taobaoId'])
		));
		if (empty($goods)) {
			$goods = new Goods();
		}

		if ($goods->end_time >= time()) {
			return false;
		}
		$data = self::setAttributes($catId, $data);
		$goods->setAttributes($data);
		$goods->save();
	}

	/**
	 * 设置商品属性
	 * @param integer $catId 分类ID
	 * @param array $U U站数据
	 * @return array 商品属性
	 */
	public static function setAttributes($catId, $U)
	{
		$data = [];
		$data['cat_id'] = $catId;
		$data['url'] = $U['url'];
		$data['title'] = $U['title'];
		$data['picture'] = '';
		$data['price'] = $U['price'];
		$data['origin_price'] = $U['origin_price'];
		$data['start_time'] = date('Y-m-d H:i:s', $U['startTime']);
		$data['end_time'] = date('Y-m-d H:i:s', $U['endTime']);
		$data['relation_website'] = 6;
		$data['goods_type'] = 0;
		$data['user_id'] = 5;
		$data['tb_id'] = $U['taobaoId'];
		return $data;
	}
}
