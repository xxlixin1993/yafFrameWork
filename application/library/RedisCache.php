<?php

/**
 *
 * @file   Redis.php
 * @author lixin1@douyu.tv
 * @date   2017-1-16
 */
class RedisCache
{
    private $_conf;

    protected static $instance;

    private function __construct()
    {
        //读配置文件 建立连接
        $this->_conf = \Yaf_Registry::get('redis');
        
        print_r($this->_conf);exit;

    }

    public static function getInstance(){
        if (empty(self::$instance)){
            self::$instance = new self();
        }
        return self::$instance;
    }
}