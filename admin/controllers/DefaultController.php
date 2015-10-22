<?php

namespace app\admin\controllers;

use Yii;
use yii\filters\AccessControl;


use app\admin\models\LoginForm;

class DefaultController extends BaseController
{

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * admin index render controllr
     * @return view indexView
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * admin login
     * @return [type] [description]
     */
    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest)
        {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login())
        {
            return $this->goBack();
        }
        else
        {
            return $this->render(
                'login', [
                    'model' => $model,
                ]
            );
        }
    }
    /**
     * logout
     * @return [type] [description]
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->goHome();
    }
}
