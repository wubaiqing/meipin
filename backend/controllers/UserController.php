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


    public function actionUpdate($id)
    {
        $user= Users::model()->findByPk($id);
        $address = UsersAddress::getModel($id);
        $province = City::getByParentId(0);
        $address->province = City::getProvinceId($address->city_id);
        $city = City::getCityList($address->province);

        $post = Yii::app()->request->getQuery('Users');
        if ($post !== null) {
            echo '123';
        }
        $this->render('update', [
            'user' => $user,
            'address' => $address,
            'province' => $province,
            'city' => $city
        ]);
    }
}
