<?php

/**
 * 积分操作控制器
 * @author liukui<liujickson@gmail.com>
 * @copyright Copyright (c) 2014 美品
 * @since 1.0
 */
class ScoreController extends Controller
{

    /**
     * @var string $layout 继承视图
     */
    public $layout = '//layouts/main';

    /**
     * 积分业务处理类
     * @var ScoreService 
     */
    public $scoreService;

    public function init()
    {
        parent::init();

        $this->scoreService = new ScoreService();
    }

    /**
     * 积分兑换首页
    /**
     * 积分管理-积分明细列表
     */
    public function actionIndex()
    {
        // 用户ID
        $userId = Yii::app()->user->id;

        // 获取用户记录
        $user = User::getUser($userId);
        // 获取用户积分记录
        $score = Score::getScoreByUserId($userId);
        //var_dump($score);
        $this->render('index', [
            'user' => $user,
            'score' => $score
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
        $score = Score::getScoreByUserId($userId,$type);
        //var_dump(json_encode($score));
        return json_encode($score);
    }
