<?php

namespace admin\modules\category\controllers;



use Yii;
use admin\modules\category\models\Category;
use admin\modules\category\models\CategorySearch;
use admin\components\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ItemsController implements the CRUD actions for admin\modules\category\models\Category model.
 */
class ItemsController extends Controller
{

    public $_left_nav = ['modules','category/items/index'];
    public $modelSearch = 'admin\modules\category\models\CategorySearch';
    public $modelClass = 'admin\modules\category\models\Category';

    public function actionIndex()
    {
        $dataProvider = $this->pageList();
        return $this->render('index',['dataProvider'=>$dataProvider]);
    }

}
