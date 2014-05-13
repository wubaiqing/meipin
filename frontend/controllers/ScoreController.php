<?php
/**
 * 积分管理
 * @author liukui<liujickson@gmail.com>
 * @copyright Copyright (c) 2014 ��Ʒ
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
        $userId = Yii::app()->user->id;
        $layout = '//layouts/user';
        $user = User::getUser($userId);
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
        $userId = Yii::app()->user->id;
        $type = $_POST['type'];
        $user = User::getUser($userId);
        $score = Score::getScoreByUserId($userId,$type);
        return json_encode($score);
    }
}
