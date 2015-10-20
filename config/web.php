<?php

$params = require(__DIR__ . '/params.php');

$config = [
    'name'=>'DanDan',
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'modules' => [
            'admin' => [
                'class' => 'app\admin\Module',
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
            'identityClass' => 'app\models\User',
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
            'useFileTransport' => true,
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
        'db' => require(__DIR__ . '/db.php'),

        //set view

        // 'view' => [
        //     'theme' => [
        //         'basePath' => '@app/themes/tfdorian',
        //         'baseUrl' => '@web',
        //         'pathMap' => [
        //             '@app/views' => '@app/themes/tfdorian',
        //         ],
        //     ],
        // ],

        'view' => [
            'theme' => [
                'basePath' => '@app/themes/tfviolet',
                'baseUrl' => '@web',
                'pathMap' => [
                    '@app/views' => '@app/themes/tfviolet',
                ],
            ],
        ],
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
