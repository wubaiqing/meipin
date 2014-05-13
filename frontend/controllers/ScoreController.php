<?php
/**
 * 积分管理
 * @author liukui<liujickson@gmail.com>
 * @copyright Copyright (c) 2014 美品网
 * @since 1.0
 */
class ScoreController extends Controller
{
    /**
     * @var string $layout
     */
    public $layout = '//layouts/main';

    /**
     * @var ScoreService 积分服务
     */
    public $scoreService;

    /**
     * 初始化积分ScoreServer
     */
    public function init()
    {
        parent::init();
        $this->scoreService = new ScoreService();
    }

    /**
     * 积分首页
     */
    public function actionIndex()
    {
        // 用户ID
        $userId = Yii::app()->user->id;
        // 使用模板
        $layout = '//layouts/user';
        // 获取用户信息
        $user = User::getUser($userId);
        // 获取用户积分
        $score = Score::getScoreByUserId($userId);
        $this->render('index', [
            'user' => $user,
            'score' => $score
        ]);
    }

    /**
     * 积分列表ajax切换
     */
    public function actionAjax()
    {
        // 用户ID
        $userId = Yii::app()->user->id;
        // 切换类型
        $type = $_POST['type'];
        // 获取用户信息
        $user = User::getUser($userId);
        // 当前用户积分信息
        $score = Score::getScoreByUserId($userId,$type);
        return json_encode($score);
    }
}
