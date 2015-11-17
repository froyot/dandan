<?php

namespace app\admin\controllers;

use Yii;
use app\models\action\Guestbook;
use app\models\form\GuestbookForm;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * GuestbookController implements the CRUD actions for Guestbook model.
 */
class GuestbookController extends BaseController implements BaseControllerInterface
{
    public $modelClass = "app\models\action\Guestbook";
    public $modelFormClass = "app\models\\form\GuestbookForm";

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
