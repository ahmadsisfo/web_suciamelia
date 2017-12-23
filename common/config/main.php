<?php
return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        /*'authManager' => [
            'class' => 'yii\rbac\DbManager'
        ],*/
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'tokenManager' => [
            'class' => 'common\classes\TokenManager'
        ],
        'formatter' => [
            'timeZone' => 'Asia/Jakarta',
            'defaultTimeZone' => 'Asia/Jakarta',
        ],
    ],
    'timeZone' => 'Asia/Jakarta'
];
