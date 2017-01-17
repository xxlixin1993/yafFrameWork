<?php
/**
 * 配置文件
 * @file   config.php
 * @author lixin1@douyu.tv
 * @date   2017-1-16
 */
define("REDIS_CONFIG", [
    'cluster' => rc('REDIS_CLUSTER', false),
    'default' => [
        [
            'host' => rc('REDIS_HOST_MASTER'),
            'port' => rc('REDIS_PORT_MASTER'),
            'password' => rc('REDIS_PASSWORD_MASTER'),
            'alias' => 'master',
        ],
        [
            'host' => rc('REDIS_HOST_SLAVE1'),
            'port' => rc('REDIS_PORT_SLAVE1'),
            'password' => rc('REDIS_PASSWORD_SLAVE1'),
            'alias' => 'slave1',
        ],
        [
            'host' => rc('REDIS_HOST_SLAVE2'),
            'port' => rc('REDIS_PORT_SLAVE2'),
            'password' => rc('REDIS_PASSWORD_SLAVE2'),
            'alias' => 'slave2',
        ]
    ],
]);