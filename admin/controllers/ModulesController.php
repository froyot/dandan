<?php

namespace admin\controllers;

use Yii;
use yii\filters\AccessControl;
use admin\components\Controller;
use yii\filters\VerbFilter;

class ModulesController extends Controller
{
    public $_left_nav = ['setting','modules/index'];
    public $modelSearch = 'admin\models\search\ModulesSearch';
    public $modelClass = 'admin\models\Modules';
    public function actionIndex()
    {
        $dataProvider = $this->pageList();
        return $this->render('index',['dataProvider'=>$dataProvider]);
    }
}
