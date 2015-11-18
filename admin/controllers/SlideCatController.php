<?php

namespace app\admin\controllers;

use Yii;
use app\models\action\slideCat;
use app\models\form\slideCatForm;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * SlideCatController implements the CRUD actions for slideCat model.
 */
class SlideCatController extends BaseController implements BaseControllerInterface
{
    public $modelClass = "app\models\action\SlideCat";
    public $modelFormClass = "app\models\\form\SlideCatForm";

    public function afterCreate( $model )
    {
        return $this->redirect(['index']);
    }

    public function afterUpdate( $model )
    {
        return $this->redirect(['index']);
    }

    public function afterDelete( $model )
    {
        return $this->redirect(['index']);
    }
    public function beforeRenderEdit( &$model )
    {

    }
}
