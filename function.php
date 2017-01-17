<?php
/**
 * @file   function.php
 * @author lixin1@douyu.tv
 * @date   2017-1-16
 */
if (!function_exists('rc')) {
    //读取redis.ini的配置中的名字

    function rc($name = '', $default = '')
    {
        if (empty($name)) {
            return $default;
        }
        $redis_conf = Yaf_Registry::get('redis');
        if (isset($redis_conf[$name])) {
            return $redis_conf[$name];
        } else {
            return $default;
        }
    }
}