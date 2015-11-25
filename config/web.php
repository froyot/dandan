<?php

$params = require __DIR__ . '/params.php';

$config = [
    'timeZone' => 'Asia/Chongqing',
    'name' => 'DanDan',
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'modules' => [
        'admin' => [
            'class' => 'app\admin\Module',
        ],

        'fronted' => [
            'class' => 'app\fronted\Module',
        ],
        'social' => [
            // the module class
            'class' => 'kartik\social\Module',
            // the global settings for the disqus widget
            'disqus' => [
                'settings' => ['shortname' => 'dandancms'], // default settings
            ],
        ],
    ],
    'language' => 'zh-CN',
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'asdfasdfgasdfgadxvxcv23r5423rszd',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\action\User',
            'enableAutoLogin' => true,
            'on afterLogin' => ['app\compoments\EventHandler', 'afterLogin'],
        ],
        'errorHandler' => [
            'errorAction' => '/fronted/site/error',
        ],

        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'myEvent' => [
            'class' => 'app\compoments\EventHandler',
        ],
        'cacheManage' => [
            'class' => 'app\models\util\CacheManage',
        ],
        'db' => array_merge(
            require (__DIR__ . '/db.php'),
            require (__DIR__ . '/db.config.php')
        ),
        'authManager' => [
            'class' => 'app\models\util\RbacDbManager',
            'itemTable' => '{{%auth_item}}',
            'itemChildTable' => '{{%auth_item_child}}',
            'assignmentTable' => '{{%auth_assignment}}',
            'ruleTable' => '{{%auth_rule}}',
        ],

    ],
    'defaultRoute' => 'fronted/site/index',
    'aliases' => [
        '@allon/yii2/ueditor' => '@app/tmp-extensions/yii2-ueditor/src',
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] =
    [
        'class' => 'yii\debug\Module',
        'allowedIPs' => ['*', '127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        'allowedIPs' => ['*', '127.0.0.1', '::1'],
    ];
}

return $config;
