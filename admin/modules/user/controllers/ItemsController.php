<?php

namespace admin\modules\user\controllers;



use Yii;
use admin\modules\user\models\Users;
use admin\modules\user\models\UsersSearch;
use admin\components\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ItemsController implements the CRUD actions for admin\modules\user\models\Users model.
 */
class ItemsController extends Controller
{

    public $_left_nav = ['modules','users/items/index'];
    public $modelSearch = 'admin\modules\user\models\UsersSearch';
    public $modelClass = 'admin\modules\user\models\Users';

    public function actionIndex()
    {
        $dataProvider = $this->pageList();
        return $this->render('index',['dataProvider'=>$dataProvider]);
    }

}
