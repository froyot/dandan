<?php

namespace app\fronted\controllers;

use app\models\util\ViewHelper;
use Yii;
use yii\web\Controller;

class DemoController extends Controller {
    public function actionChangeTheme() {

        $_theme = Yii::$app->request->get('theme');
        if ($_theme) {
            if ($_theme == 'default') {
                Yii::$app->session->set('_theme', null);
                return $this->goHome();
            }
            if (in_array($_theme, ViewHelper::getThemeList())) {
                Yii::$app->session->set('_theme', $_theme);
                return $this->goHome();
            }
        } else {

        }
    }
}
