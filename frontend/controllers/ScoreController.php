<?php

/**
 * ��ֲ���������
 * @author liukui<liujickson@gmail.com>
 * @copyright Copyright (c) 2014 ��Ʒ
 * @since 1.0
 */
class ScoreController extends Controller
{

    /**
     * @var string $layout �̳���ͼ
     */
    public $layout = '//layouts/main';

    /**
     * ���ҵ������
     * @var ScoreService 
     */
    public $scoreService;

    public function init()
    {
        parent::init();

        $this->scoreService = new ScoreService();
    }

    /**
     * ��ֶһ���ҳ
    /**
     * ��ֹ���-�����ϸ�б�
     */
    public function actionIndex()
    {
        // �û�ID
        $userId = Yii::app()->user->id;
        $layout = '//layouts/user';
        // ��ȡ�û���¼
        $user = User::getUser($userId);
        // ��ȡ�û���ּ�¼
        $score = Score::getScoreByUserId($userId);
        //var_dump($score);
        $this->render('index', [
            'user' => $user,
            'score' => $score
        ]);
    }


    /**
     * ��ֹ���-��������б�
     */
    public function actionAjax()
    {
        // �û�ID
        $userId = Yii::app()->user->id;
        $type = $_POST['type'];
        // ��ȡ�û���¼
        $user = User::getUser($userId);
        // ��ȡ�û���ּ�¼
        $score = Score::getScoreByUserId($userId,$type);
        //var_dump(json_encode($score));
        return json_encode($score);
    }
}
