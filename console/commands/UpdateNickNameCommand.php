<?php

/**
 * 同步今天值得买数据
 */
class UpdateNickNameCommand extends CConsoleCommand
{
    public function actionIndex()
    {
        $model = User::model()->findAll([
            'condition' => 'qq_openid <> :qq_openid',
            'params' => [':qq_openid' => 'NULL']
        ]);

        foreach ($model as $item) {
            $nickName = 'qq' . date('m') . $item->id . date('d');
            $item->username = $nickName;
            $item->save();
        }

    }
}
