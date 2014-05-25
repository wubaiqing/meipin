<?php

/**
 * 用户管理
 * @author wubaiqing <wubaiqing@vip.qq.com>
 * @copyright Copyright (c) 2014 美品网
 * @since 1.0
 */
class ScoreController extends Controller
{

    /**
     * @var string $layout
     */
    public $layout = '//layouts/user';

    /**
     * 验证码
     */
    public function actions()
    {
        return [
            'captcha' => [
                'class' => 'CCaptchaAction',
                'backColor' => 0xFFFFFF,
                'maxLength' => 4,
                'minLength' => 4,
                'height' => 40,
                'width' => 120,
            ]
        ];
    }

    /**
     * 访问权限
     */
    public function accessRules()
    {
    return array_merge([
        [
        'deny',
        'actions' => ['index', 'ajax'],
        'users' => ['?'],
        ]
    ], parent::accessRules());
    }

    /**
     * 积分管理-积分明细列表
     */
    public function actionIndex($page = 1, $type = 'index')
    {
        // 用户ID
        $userId = Yii::app()->user->id;

        // 获取用户记录
        $user = User::getUser($userId);
        $page = Yii::app()->request->getParam('page');
        $type = Yii::app()->request->getParam('type');
        $type = key_exists($type, Score::$page_type) ? $type : 'index';

        // 获取用户积分记录
        $score = Score::getScoreByUserId($userId, $type, $page);

        $this->render('index', [
            'user' => $user,
            'type' => $type,
            'score' => $score['data'],
            'pager' => $score['pager'],
        ]);
    }

    /**
     * 积分管理-积分增加列表
     */
    public function actionAjax()
    {
        // 用户ID
        $userId = Yii::app()->user->id;
        $type = $_POST['type'];
        // 获取用户记录
        $user = User::getUser($userId);
        // 获取用户积分记录
        $score_arr = Score::getScoreByUserId($userId, $type);
        foreach ($score_arr as $score) {
            $array['id'] = $score['id'];
            $array['score'] = $score['score'];
            $array['user_id'] = $score['user_id'];
            $array['reason'] = $score['reason'];
            $array['create_time'] = $score['create_time'];
        }
        //var_dump(json_encode($score));
        return json_encode($score);
    }

    /**
     * 跳转首页
     */
    public function renderIndex($status, $message)
    {
        $this->render('loginSuccess', [
            'status' => $status,
            'message' => $message,
            'url' => $this->createAbsoluteUrl('site/index')
        ]);
        Yii::app()->end();
    }

}
