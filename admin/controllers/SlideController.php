<?php

namespace app\admin\controllers;

use Yii;
use app\models\action\slide;
use app\models\form\slideForm;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * SlideController implements the CRUD actions for slide model.
 */
class SlideController extends BaseController implements BaseControllerInterface
{
    public $modelClass = "app\models\action\Slide";
    public $modelFormClass = "app\models\\form\SlideForm";

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
