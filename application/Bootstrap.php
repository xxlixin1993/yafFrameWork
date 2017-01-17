<?php
use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Events\Dispatcher as LDispatcher;
use Illuminate\Container\Container as LContainer;

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
        //框架配置
        $this->_config = Yaf_Application::app()->getConfig();
        Yaf_Registry::set("application", $this->_config);
        //加载基础函数
        Yaf_Loader::import(APP_PATH . "/function.php");

    }

    public function _initRedis(){
        //redis配置
        $redis_config = new Yaf_Config_Ini(APP_PATH . "/conf/redis.ini", RUN_ENVIRON);
        Yaf_Registry::set('redis', $redis_config->toArray());
        Yaf_Loader::import(APP_PATH . "/application/redis.php");
        //得到redis实例后注册Yaf_Registry
        $redis_conn = CacheFactory::connCache('redis');
        
        print_r($redis_config->count());exit;
    }
    /**
     * 加载初始化
     * @author lixin1@douyu.tv
     */
    public function _initAutoload()
    {
        //设置yaf启用自动加载用于兼容composer(composer中会有class_exists(PDOConnection::class)而PDOConnection根本不存在的情况)
        ini_set('yaf.use_spl_autoload', true);

        spl_autoload_register(function ($class) {
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
     * 加载composer类库
     * @throws Yaf_Exception
     * @author lixin1@douyu.tv
     */
    public function _initLoader()
    {
        if (file_exists(ROOT_PATH . '/vendor/autoload.php')) {
            Yaf_Loader::import(ROOT_PATH . '/vendor/autoload.php');
        } else {
            throw new Yaf_Exception('Plz composer update');
        }
    }


    /**
     * 初始化 Eloquent ORM
     * @author lixin1@douyu.tv
     */
    public function _initDefaultDbAdapter()
    {
        //数据库配置
        $db_conf = new Yaf_Config_Ini(APP_PATH . "/conf/database.ini", RUN_ENVIRON);
        Yaf_Registry::set('db', $db_conf->toArray());

        $capsule = new Capsule();
        $capsule->addConnection([
            'driver' => 'mysql',
            'host' => '172.16.1.112',
            'database' => 'stt_yushow',
            'username' => 'stt_yuba',
            'port' => 3306,
            'password' => 'stt_yuba',
            'charset' => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix' => '',
        ]);

        $capsule->setEventDispatcher(new LDispatcher(new LContainer));
        $capsule->setAsGlobal();
        $capsule->bootEloquent();
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
            ini_set('xhprof.output_dir', $this->_config['application']['logdir'] . 'xhprof');
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