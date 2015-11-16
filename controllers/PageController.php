<?php

namespace app\controllers;

use Yii;
use app\models\action\Post;
use app\models\form\PostForm;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\action\TermRelationship;

/**
 * PostController implements the CRUD actions for Post model.
 */
class PageController extends BaseController implements BaseControllerInterface
{
    public static $SCENARIO_INSERT = 'page';
    public static $SCENARIO_UPDATE = 'page';
    public $modelClass = "app\models\action\Post";
    public $modelFormClass = "app\models\\form\PostForm";

    public function beforeAction( $action )
    {
        if( $action->id == 'index' )
        {
            $this->addParams['post_type'] = 'page';
        }
        return true;
    }
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
