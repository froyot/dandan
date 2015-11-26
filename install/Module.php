<?php

namespace app\install;
use Yii;

class Module extends \yii\base\Module {
    public $controllerNamespace = 'app\install\controllers';

    public function init() {
        parent::init();
        if (file_exists(__DIR__ . "/install.lock")) {
            die('already installed');
        }
        \Yii::configure($this, require (__DIR__ . '/config/config.php'));

        // custom initialization code goes here
    }
}
