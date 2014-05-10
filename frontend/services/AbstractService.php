<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AbstractService
 *
 * @author liukui
 */
abstract class AbstractService extends CComponent
{

    public $enableCache = true;
    public $enableDebug = false;

    public function __construct()
    {
        $this->enableCache = CommonHelper::getEnableCache();
        $this->enableDebug = CommonHelper::getEnableDebug();
    }

}
