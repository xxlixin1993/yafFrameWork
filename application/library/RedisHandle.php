<?php

/**
 * redis操作类 
 * 定义redis key 和 对redis的具体操作
 * @file   Redis.php
 * @author lixin1@douyu.tv
 * @date   2017-1-17
 */
class RedisHandle
{
    public function __construct()
    {
        $this->handler = Yaf_Registry::get('redis_conn');
    }
}