<?php
require_once dirname(__DIR__).'/qqlogin/API/qqConnectAPI.php';
class Qlogin extends CComponent
{
	public $qcc;
	function __construct()
	{
        $this->qcc = new QC();
	}

     function qq_login()
     {
     	return $this->qcc->qq_login();
     }
	//$qc = new QC();
	//$qc->qq_login();
}
