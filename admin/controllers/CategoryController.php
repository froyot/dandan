<?php

namespace app\admin\controllers;

use Yii;
use app\models\db\Params;
use app\admin\models\ParamsForm;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

class CategoryController extends ParamsController
{
    protected $paramsType = 'cat';

    protected function saveModel( &$model )
    {
        return $model->saveCategory();
    }
}
