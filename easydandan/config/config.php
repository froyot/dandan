<?php
Yii::setAlias('@easydandan', dirname(__DIR__));
return [
    'modules' => [
        'admin' => [
            'class' => 'easydandan\DandanModule',
            'defaultRoute'=>'site'
        ],
    ],
    'components' => [
        'admin' => [
            'class'=>'yii\web\User',
            'identityClass' => 'easydandan\models\action\Admin',
            'idParam' => '__adminid',
            'identityCookie' => ['name' => '__admin_identity', 'httpOnly' => true],
            'enableAutoLogin' => true,
            'authTimeout' => 86400,
            'loginUrl' => ['/admin/public/login'],
        ],
        'i18n' => [
            'translations' => [
                'easydandan' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'sourceLanguage' => 'en-US',
                    'basePath' => '@easydandan/messages',
                    'fileMap' => [
                        'easydandan' => 'admin.php',
                    ]
                ]
            ],
        ]
    ]
];
?>
