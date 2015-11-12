<?php

$params = require(__DIR__ . '/params.php');
require(__DIR__.'/ucenter.php');

$config = [
    'name'=>'DanDan',
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'modules' => [
            'admin' => [
                'class' => 'app\admin\Module',
            ],
            'social' => [
                // the module class
                'class' => 'kartik\social\Module',

                // the global settings for the disqus widget
                'disqus' => [
                    'settings' => ['shortname' => 'dandancms'] // default settings
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
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => false,
            'transport' => [
               'class' => 'Swift_SmtpTransport',
               'host' => 'smtp.sina.com',  //每种邮箱的host配置不一样
               'username' => 'inwatch_mail@sina.com',
               'password' => 'inwatch',
               'port' => '25',
               'encryption' => 'tls',

                           ],
            'messageConfig'=>[
               'charset'=>'UTF-8',
               'from'=>['inwatch_mail@sina.com'=>'admin']
               ],
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
        'db' => array_merge(
            require(__DIR__ . '/db.php'),
            require(__DIR__.'/db-local.php')
            ),

    ],
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
    'class'=>'yii\debug\Module',
        'allowedIPs' => ['*', '127.0.0.1', '::1']
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
    'class'=>'yii\gii\Module',
        'allowedIPs' => ['*', '127.0.0.1', '::1']
    ];
}

return $config;
