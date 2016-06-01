<?php

namespace easydandan\controllers;
use Yii;
use yii\web\Controller;
use easydandan\models\form\LoginForm;
/**
 * Default controller for the `easydandan` module
 */
class PublicController extends Controller
{
    public $layout = '@easydandan/views/layouts/fullPage';
    /**
     * Renders the index view for the module
     * @return string
     */

    public function actionLogin()
    {
        if (!Yii::$app->admin->isGuest) {
            return $this->goAdminHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }


    public function actionLogout()
    {
        Yii::$app->admin->logout();

        return $this->goHome();
    }

    public function actionRegister()
    {
        if (!Yii::$app->admin->isGuest) {
            return $this->goAdminHome();
        }

        $model = new RegisterForm();
        if ($model->load(Yii::$app->request->post()) && $model->register()) {
            return $this->goBack();
        }
        return $this->render('register', [
            'model' => $model,
        ]);
    }
    public function goAdminHome()
    {
        return $this->redirect(['admin/site/index']);
    }
}
