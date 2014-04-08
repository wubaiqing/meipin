<?php
/**
 * 前台Banner管理
 * @author wubaiqing<wubaiqing@vip.qq.com>
 * @copyright Copyright (c) 2013 今天值得买
 * @since 1.5
 */
class BannerController extends Controller
{
    /**
     * 前台banner管理
     */
    public function actionAdmin()
    {
        $model = new Banner();
        $top = $model->findByPk(1);
        $footer = $model->findByPk(2);

        if (isset($_POST['Top']) && isset($_POST['Footer'])) {
            // 头部
            $top->url = $_POST['Top']['url'];
            $top->picture = $_POST['Top']['picture'];
            $top->width = $_POST['Top']['width'];
            $top->height = $_POST['Top']['height'];
            $top->color = $_POST['Top']['color'];
            $top->save();

            // 底部
            $footer->url = $_POST['Footer']['picture'];
            $footer->save();
            User::deleteCache();
        }

        $this->render('admin', array(
            'top' => $top,
            'footer' => $footer,
        ));
    }
}
