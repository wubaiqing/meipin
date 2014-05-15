<?php
/**
 * 业务服务抽象类主体
 *
 * @author liukui
 */
abstract class AbstractService extends CComponent
{

    /**
     * 是否启用缓存
     * @var boolean 
     */
    public $enableCache = true;
    /**
     * 是否启用调试模式
     * @var boolean 
     */
    public $enableDebug = false;

    public function __construct()
    {
        $this->enableCache = CommonHelper::getEnableCache();
        $this->enableDebug = CommonHelper::getEnableDebug();
    }

}
