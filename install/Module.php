<?php

namespace app\install;

class Module extends \yii\base\Module {
    public $controllerNamespace = 'app\install\controllers';

    public function init() {
        parent::init();
        if (file_exists(__DIR__ . "/install.lock")) {
            die('already installed');
        }
        // custom initialization code goes here
    }
}
