<?php

namespace app\controllers;

use Yii;
use app\models\action\Post;
use app\models\form\PostForm;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;



class PostController  extends Controller
{
    //列表显示
    public function actionIndex()
    {
        $searchModel = new PostForm();
        $dataProvider = $searchModel->search(
            ArrayHelper::merge(
                Yii::$app->request->queryParams,
                ['post_type'=>'post']
            )
        );

        return $this->render('index',[
                                    'dataProvider'=>$dataProvider,
                                    'searchModel'=>$searchModel
                                    ]
                            );
    }

    //查看详情
    public function actionView()
    {

    }

}
