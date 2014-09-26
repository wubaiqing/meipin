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
     * 用户操作日志
     */
    public function actionUserlog()
    {
        $model = new UserLoginLog();
        $model->unsetAttributes();
        if (isset($_GET['UserLoginLog'])) {
            $model->attributes = Yii::app()->request->getQuery(CHtml::modelName($model));
        }
        $this->render('userlog', [
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
            //如果不等于之前的积分证明是要修改积分了，此时保存修改记录
            if($user->score != $post['score'])
            {
                //日志
                $username = Yii::app()->user->id;
                $score = new Score();
                $score->attributes = [
                    'score' => $post['score'],
                    'user_id' => $user->id,
                    'reason' => 2,
                    'remark' => "由于系统出错，管理员{$username}将{$user->score}改成了{$post['score']}"
                ];
                $score->insert();
                $user->score = $post['score'];
                $user->update(['score']);
            }

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
