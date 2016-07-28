<?php

namespace admin\modules\posts\controllers;



use Yii;
use admin\modules\posts\models\Posts;
use admin\modules\posts\models\PostsSearch;
use admin\components\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ItemsController implements the CRUD actions for admin\modules\posts\models\Posts model.
 */
class ItemsController extends Controller
{

    public $_left_nav = ['modules','posts/items/index'];
    public $modelSearch = 'admin\modules\posts\models\PostsSearch';
    public $modelClass = 'admin\modules\posts\models\Posts';

    public function actionIndex()
    {
        $dataProvider = $this->pageList();
        return $this->render('index',['dataProvider'=>$dataProvider]);
    }

}
