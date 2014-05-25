<?php
/**
 * 用户管理
 * @author wubaiqing <wubaiqing@vip.qq.com>
 * @copyright Copyright (c) 2014 美品网
 * @since 1.0
 */
class UserAddressController extends Controller
{
    public function actionGetProvince($provinceId)
    {
        $cities = City::getByParentId($provinceId);
        if (empty($cities)) {
            $this->returnData(0, ['test']);
        }
        $this->returnData(1, City::getItem($cities));
    }
}
