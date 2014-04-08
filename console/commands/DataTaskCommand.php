<?php
/**
 * 同步今天值得买数据
 */
class DataTaskCommand extends CConsoleCommand 
{
	public function actionIndex()
	{
        $getJson = file_get_contents('http://admin.jtzdm.com/index.php?r=api/getgoods');
        $json = json_decode(strval($getJson), true);
        foreach ($json as $key => $val)
        {
            $goods = Goods::model()->findByAttributes(array('url' => $val['url']));
            if (!empty($goods)) {
                echo $goods->id . '已经存在' . "\n";
            } else {
                $goods = new Goods();
                unset($val['id']);
            }
            $goods->attributes = $val;
            $goods->start_time = date('Y-m-d H:i:s', $goods->start_time);
            $goods->end_time = date('Y-m-d H:i:s', $goods->end_time);
            $goods->goodsType = $goods->goods_type;
            $goods->save();
            echo $goods->id . "\n";
        }
	}
}
