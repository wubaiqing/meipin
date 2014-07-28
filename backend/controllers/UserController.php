<?php

/**
 * 用户管理
 *
 * @author wubaiqing
 */
class UserController extends Controller
{

        //判断是否登陆，没有登陆就返回登陆
    public function beforeAction($action)
    {
       if (!Yii::app()->user->id) {
         $this->redirect(array('site/login'));
       }

       return parent::beforeAction($action);
    }

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
     * 用户积分详情
     */
    public function actionExdetail($uid,$um)
    {
        $model = Score::model();
        $this->render('score', [
            'model' => $model,
            'uid'=>$uid,
            'um'=>$um,
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
        if ($post !== null && $postAddress !== null) {
            $user->mobile_bind = $post['mobile_bind'];
            $user->mobile = $post['mobile'];
            $user->update(['mobile_bind']);
            $user->update(['mobile']);

            $address->user_id = $id;
            $address->attributes = $postAddress;
            $address->save();
            $this->redirect(['admin']);
        }
        $this->render('update', [
            'user' => $user,
            'address' => $address,
            'province' => $province,
            'city' => $city
        ]);
    }


    /*
     *用户统计
    */
    public function actionUserinfo()
    {
        $users = new Users();
        $users->attributes = Yii::app()->request->getQuery(CHtml::modelName($users));
        $this->render("userinfo",['usermodel'=>$users]);

    }
}
