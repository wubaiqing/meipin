<?php

/**
 *  相关帮组类
 * @author liukui
 */
class ExchangeHelper
{

    /**
     * 处理兑换商品颜色
     * @param Exchange $exchange 
     * @return Exchange 
     */
    public static function formatExchangeGoodsColor(Exchange $exchange)
    {
        $gdcolorstr = $exchange->goodscolor;
        if ($gdcolorstr) {
            $gdcolorarr = explode(';', $gdcolorstr);
            foreach ($gdcolorarr as $key => $value) {
                if ($value) {
                    $gdcolorstr2 = explode(':', $value);
                    $arr[$key]['gdcolornum'] = $gdcolorstr2[1] ? $gdcolorstr2[1] : 0;
                    $arr[$key]['gdcolorname'] = $gdcolorstr2[0];
                }
            }
            $exchange->goodscolor = $arr;
        }
        return $exchange;
    }

}
