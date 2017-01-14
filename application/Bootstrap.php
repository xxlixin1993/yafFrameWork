<?php

/**
 * 所有在Bootstrap类中, 以_init开头的方法, 都会被Yaf调用,
 * 这些方法, 都接受一个参数:Yaf_Dispatcher $dispatcher
 * 调用的次序, 和申明的次序相同
 */
class Bootstrap extends Yaf_Bootstrap_Abstract
{

    private $_config;

    /**
     * 加载配置文件
     * @author lixin1@douyu.tv
     */
    public function _initConfig()
    {
        $this->_config = Yaf_Application::app()->getConfig();
        Yaf_Registry::set("config", $this->_config);
    }


    /**
     * 注册一个插件
     * @param Yaf_Dispatcher $dispatcher
     * @author lixin1@douyu.tv
     */
    public function _initPlugin(Yaf_Dispatcher $dispatcher)
    {
        $dispatcher->registerPlugin(new XhprofPlugin());
    }

    public function _initRoute()
    {
        $route_conf = new Yaf_Config_Ini(APP_PATH . "/conf/route.ini");
        Yaf_Dispatcher::getInstance()->getRouter()->addConfig($route_conf->routes);

    }
}