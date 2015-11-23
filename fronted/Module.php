<?php

namespace app\fronted;
use Yii;
use app\models\util\ViewHelper;

class Module extends \yii\base\Module
{
    public $controllerNamespace = 'app\fronted\controllers';

    public function init()
    {
        parent::init();
        $themes = ViewHelper::getSiteOption('site_themes');
        // var_dump($themes);die;
        // custom initialization code goes here
        //主题
        Yii::$app->view->theme = Yii::createObject([
            'class' => '\yii\base\Theme',
            'baseUrl' => '@web',
            'basePath' => '@app/themes/'.$themes,
            'pathMap' => [
                    '@app/views' => '@app/themes/'.$themes,
            ],
        ]);
    }
}
