<?php

/**
 * 缓存工厂类
 * @file   CacheFactory.php
 * @author lixin1@douyu.tv
 * @date   2017-1-16
 */
class CacheFactory
{
    public static function connCache($type = 'redis')
    {
        if ($type == 'redis') {
            if (!extension_loaded('redis')) {
                throw new \Yaf_Exception('Failed to load redis extension');
            } else {
                return RedisCache::getInstance();
            }
        } elseif ($type == 'memcache') {
            //TODO
            throw new \Yaf_Exception('Failed to load memcache extension');
        } else {
            throw new \Yaf_Exception('Failed to load cache extension');
        }
    }
}