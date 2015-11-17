<?php

namespace app\admin\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\form\LoginForm;
use app\models\form\RegisterForm;
use yii\base\InvalidParamException;
use app\models\action\User;
class SiteController extends Controller
{
    public $layout = 'main';
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout','index'],
                'rules' => [
                    [
                        'actions' => ['logout','index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

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

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * register user
     * method: post
     * @param string username
     * @param string $password
     * @param string $email
     */
    // public function actionRegister()
    // {
    //     if (!\Yii::$app->user->isGuest) {
    //         return $this->goHome();
    //     }

    //     $model = new RegisterForm();
    //     if ( $model->load(Yii::$app->request->post()) )
    //     {
    //         switch( $model->register() )
    //         {
    //             case 1: $this->goHome();return;break;
    //             case 0: $this->goHome();
    //         }
    //     }
    //     return $this->render('register', [
    //         'model' => $model,
    //     ]);
    // }

    // /**
    //  * 激活用户
    //  * @return [type] [description]
    //  */
    // public function actionActive()
    // {
    //     $code = Yii::$app->request->get('code');
    //     if( !$code || strlen($code) < 32 )
    //     {
    //         throw new InvalidParamException(Yii::t('app',"invalid params"));
    //         exit;
    //     }
    //     $hash = substr($code,32);
    //     if( substr(md5($hash),0,16) != substr($code,0,16) )
    //     {
    //         throw new InvalidParamException(Yii::t('app',"invalid params"));
    //         exit;
    //     }
    //     if( User::activeUser( $code) )
    //     {
    //         $this->goHome();
    //     }
    //     else
    //     {
    //         Yii::error('active user error '.$code);
    //         return 'error';
    //     }
    // }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }


}
