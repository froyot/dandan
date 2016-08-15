<?php

namespace admin\modules\tags\controllers;



use Yii;
use admin\modules\tags\models\Tags;
use admin\modules\tags\models\TagsSearch;
use admin\components\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ItemsController implements the CRUD actions for admin\modules\tags\models\Tags model.
 */
class ItemsController extends Controller
{

    public $_left_nav = ['modules','tags/items/index'];
    public $modelSearch = 'admin\modules\tags\models\TagsSearch';
    public $modelClass = 'admin\modules\tags\models\Tags';

    public function actionIndex()
    {
        $dataProvider = $this->pageList();
        return $this->render('index',['dataProvider'=>$dataProvider]);
    }

}
