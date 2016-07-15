<?php

namespace admin\controllers;

use Yii;
use yii\filters\AccessControl;
use admin\components\Controller;
use yii\filters\VerbFilter;

class OptionsController extends Controller
{
    public $_left_nav = ['setting','options/index'];
    public $modelSearch = 'admin\models\search\OptionsSearch';
    public function actionIndex()
    {

        $dataProvider = $this->pageList();
        return $this->render('index',['dataProvider'=>$dataProvider]);
    }
}
