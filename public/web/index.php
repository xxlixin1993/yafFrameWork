<?php
define("APP_PATH", realpath(dirname(__FILE__) . '/../../'));
define('ROOT_PATH', dirname(__DIR__) . '/../');
define("RUN_ENVIRON", 'develop');
//TODO product时把错误写日志
if (RUN_ENVIRON == "develop" || RUN_ENVIRON == "staging" || RUN_ENVIRON == "gray") {
    error_reporting(E_ALL);
} else {
    error_reporting(0);
}

$app = new Yaf_Application(APP_PATH . "/conf/application.ini");
$app->bootstrap()->run();