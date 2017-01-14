<?php
define("APP_PATH", realpath(dirname(__FILE__) . '/../../'));

//TODO product时把错误写日志
if (strpos(APP_PATH, 'yaf') > 0) {
    define("RUN_ENVIRON", 'develop');
    error_reporting(E_ALL);
} else {
    define("RUN_ENVIRON", 'product');
    error_reporting(0);
}

$app = new Yaf_Application(APP_PATH . "/conf/application.ini");
$app->bootstrap()->run();