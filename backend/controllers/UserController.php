<?php

/**
 * 用户管理
 *
 * @author wubaiqing
 */
class UserController extends Controller
{
    /**
     * 用户管理列表
     */
    public function actionAdmin()
    {
        $model = new Users();
        $model->unsetAttributes();
        if (isset($_GET['Users'])) {
            $model->attributes = Yii::app()->request->getQuery(CHtml::modelName($model));
        }
        $this->render('admin', [
            'model' => $model,
        ]);
    }


    /**
     * 修改用户信息
     * @param integer $id 用户ID
     */
    public function actionUpdate($id)
    {
        $user= Users::model()->findByPk($id);
        $address = UsersAddress::getModel($id);
        $province = City::getByParentId(0);
        $address->province = City::getProvinceId($address->city_id);
        $city = City::getCityList($address->province);

	$post = Yii::app()->request->getPost('Users');
	$postAddress = Yii::app()->request->getPost('UsersAddress');
        if ($post !== null) {
	    var_dump($post);
	    var_dump($postAddress);
	    exit;
        }
        $this->render('update', [
            'user' => $user,
            'address' => $address,
            'province' => $province,
            'city' => $city
        ]);
    }
}
