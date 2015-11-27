<?php

namespace app\fronted;
use app\models\util\ViewHelper;
use Yii;

class Module extends \yii\base\Module {
    public $controllerNamespace = 'app\fronted\controllers';

    public function init() {
        parent::init();
        $themes = ViewHelper::getSiteOption('site_themes');

        if (Yii::$app->session->get('_theme')) {

            $themes = Yii::$app->session->get('_theme');
        }
        if (!$themes) {
            //默认主题
            $this->layout = "main";
        }
        // custom initialization code goes here
        //主题
        Yii::$app->view->theme = Yii::createObject([
            'class' => '\yii\base\Theme',
            'baseUrl' => '@web',
            'basePath' => '@app/themes/' . $themes,
            'pathMap' => [
                '@app/views' => '@app/themes/' . $themes,
            ],
        ]);
        // var_dump(Yii::$app->view->theme);die;
    }
}
