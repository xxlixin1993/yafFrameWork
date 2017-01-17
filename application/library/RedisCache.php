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

    private function __construct($section)
    {
        //读配置文件 建立连接
        $this->_conf = Yaf_Registry::get('redis');
print_r($this->_conf);exit;
        //集群
        if ($this->_conf['cluster'] == true) {

        } else {
            $len = count($this->_conf[$section]);
            if ($len < 1) {
                throw new Yaf_Exception('Redis conf error');
            } else if ($len == 1) {
                //单个

            } else {
                //主从

            }
        }


    }

    public static function getInstance($section = 'default')
    {
        if (empty(self::$instance)) {
            self::$instance = new self($section);
        }
        return self::$instance;
    }
}