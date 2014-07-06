<?php

/**
 * 字符串帮组类
 *
 * @author liukui
 */
class StringHelper
{

    /**
     * 获取UTF-8字符的长度
     * <p>
     * 先用正则将字符串分解为个体单元，然后再计算单元的个数即字符串的长度，代码如下（只能处理utf-8编码下的字符串）
     * </p>
     * @param string $string 需要判断长度的字符串
     */
    public static function Utf8Strlen($string = null)
    {
        // 将字符串分解为单元
        preg_match_all("/./us", $string, $match);
        // 返回单元个数
        return count($match[0]);
    }

    /**
     * 截取UTF-8字符串
     * @param string $str 需要被截取的字符串长度
     * @param int $start 被截取字符串的开始位置
     * @return string 被截取的字符串
     */
    public static function Utf8Substr($str, $start, $end)
    {
        $null = "";
        preg_match_all("/./us", $str, $ar);
        if (func_num_args() >= 3) {
            $end = func_get_arg(2);
            $result = join($null, array_slice($ar[0], $start, $end));
            return self::Utf8Strlen($str) > $end ? $result . "..." : $result;
        } else {
            return join($null, array_slice($ar[0], $start));
        }
    }

}
