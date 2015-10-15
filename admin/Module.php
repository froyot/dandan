<?php

namespace app\admin;

class Module extends \yii\base\Module
{
    public $controllerNamespace = 'app\admin\controllers';

    public function init()
    {
        parent::init();

        \Yii::$app->view->theme = new \yii\base\Theme([
            'pathMap' => ['@app/views' => '@app/admin/views'],
            'baseUrl' => '@web',
        ]);
        \Yii::$app->user->identityClass = 'app\admin\models\User';
        \Yii::$app->user->loginUrl=['/'.$this->id.'/default/login'];
        \Yii::$app->setHomeUrl(['/admin/default/index']);
        // custom initialization code goes here
    }
}
