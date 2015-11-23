<?php
return [
    'components' => [
        'view'=>[
            'class' => '\yii\base\View',
            'theme' => [
                'pathMap' => ['@app/views' => '@app/themes/basic'],
                'baseUrl' => '@web/themes/basic',
                'class' => '\yii\base\Theme',
                'baseUrl' => '@webroot/themes/basic/web',
                'basePath' => '@app/themes/basic',
            ]
        ],
        // list of component configurations
    ],
    'params' => [
        // list of parameters
    ],
];
