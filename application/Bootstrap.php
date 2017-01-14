<?php

/**
 * 所有在Bootstrap类中, 以_init开头的方法, 都会被Yaf调用,
 * 这些方法, 都接受一个参数:Yaf_Dispatcher $dispatcher
 * 调用的次序, 和申明的次序相同
 */
class Bootstrap extends Yaf_Bootstrap_Abstract
{
    /**
     * @var object 配置文件
     */
    private $_config;

    /**
     * 加载配置文件
     * @author lixin1@douyu.tv
     */
    public function _initConfig()
    {
        $this->_config = Yaf_Application::app()->getConfig();
        Yaf_Registry::set("application", $this->_config);
    }

    /**
     * 加载初始化
     * @param Yaf_Dispatcher $dispatcher
     * @author lixin1@douyu.tv
     */
    private function _initAutoload(Yaf_Dispatcher $dispatcher)
    {
        //设置yaf启用自动加载用于兼容composer
        ini_set('yaf.use_spl_autoload', true);

        //models目录中命名空间autoload
        spl_autoload_register(function ($class) {
            var_dump($class);
            if ($class) {
                $file = str_replace('\\', '/', __DIR__ . '/' . $class);
                $file = $file . '.php';
                if (file_exists($file)) {
                    Yaf_Loader::import($file);
                }
            }
        });
    }

    /**
     * 注册一个插件
     * @param Yaf_Dispatcher $dispatcher
     * @author lixin1@douyu.tv
     */
    public function _initPlugin(Yaf_Dispatcher $dispatcher)
    {
        //加载xhprof插件
        if (extension_loaded('xhprof')) {
            //加载xhprof日志类
            Yaf_Loader::import("ThirdPartyLib/xhprof/utils/xhprof_lib.php");
            Yaf_Loader::import("ThirdPartyLib/xhprof/utils/xhprof_runs.php");
            //设置xhprof日志存放路径
            ini_set('xhprof.output_dir', $this->_config['application']['logdir'].'xhprof');
            $dispatcher->registerPlugin(new XhprofPlugin());
        }

    }

    /**
     * 注册路由
     * @author lixin1@douyu.tv
     */
    public function _initRoute()
    {
        $route_conf = new Yaf_Config_Ini(APP_PATH . "/conf/route.ini");
        Yaf_Dispatcher::getInstance()->getRouter()->addConfig($route_conf->routes);

    }
}