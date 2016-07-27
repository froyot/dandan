<?php
namespace admin\modules\user\controllers;

use Yii;
use yii\filters\AccessControl;
use admin\components\Controller;
use yii\filters\VerbFilter;


class ItemsController extends Controller {


    public $_left_nav = ['modules','user/items/index'];
    public $modelSearch = 'admin\modules\user\models\UsersSearch';
    public $modelClass = 'admin\modules\user\models\Users';
    public function actionIndex()
    {
        $dataProvider = $this->pageList();
        return $this->render('index',['dataProvider'=>$dataProvider]);
    }

}
