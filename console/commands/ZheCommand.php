<?php
/**
 * 折800抓取
 */
include Yii::getPathOfAlias('common.extensions') . '/simple_html_dom.php';

class ZheCommand extends CConsoleCommand
{
	public function actionIndex()
	{
		$html = file_get_html('http://www.baidu.com/');
		var_dump($html);
	}
}

