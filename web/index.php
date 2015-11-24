<?php

// comment out the following two lines when deployed to production
defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'dev');
defined('YII_ENV_DEV') or define('YII_ENV_DEV', true);
require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../vendor/yiisoft/yii2/Yii.php';

$config = require __DIR__ . '/../config/web.php';

//check if installed
if (file_exists(__DIR__ . "/../install") && !file_exists(__DIR__ . "/../install/install.lock")) {
    $config['modules']['install'] = [
        'class' => 'app\install\Module',
    ];
    $config['defaultRoute'] = 'install/default/index';
}

(new yii\web\Application($config))->run();
