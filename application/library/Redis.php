<?php

/**
 * redis操作类
 * @file   Redis.php
 * @author lixin1@douyu.tv
 * @date   2017-1-17
 */
class Redis
{
    public function __construct()
    {
        $this->handler = Yaf_Registry::get('redis_conn');
    }
}