<?php
Yii::setAlias('@admin', dirname(__DIR__));
return [
    'modules' => [
        'admin' => [
            'class' => 'admin\Module',
            'defaultRoute'=>'site'
        ],
    ],
    'components' => [
        'admin' => [
            'class'=>'yii\web\User',
            'identityClass' => 'admin\models\action\Admin',
            'idParam' => '__adminid',
            'identityCookie' => ['name' => '__admin_identity', 'httpOnly' => true],
            'enableAutoLogin' => true,
            'authTimeout' => 86400,
            'loginUrl' => ['/admin/public/login'],
        ]

    ]
];
?>
