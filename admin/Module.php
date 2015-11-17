<?php

namespace app\admin;

class Module extends \yii\base\Module
{
    public $controllerNamespace = 'app\admin\controllers';

    public function init()
    {
        parent::init();
        \Yii::$app->user->loginUrl=['/'.$this->id.'/site/login'];
        \Yii::$app->setHomeUrl(['/admin/site/index']);
    }
}
