<?php

namespace app\admin\controllers;

use Yii;


class NavCatController extends BaseController implements BaseControllerInterface
{
    public $modelClass = "app\models\action\NavCat";
    public $modelFormClass = "app\models\\form\NavCatForm";

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
