<?php

namespace app\controllers;

use Yii;


class UserController extends BaseController implements BaseControllerInterface
{
    public $modelClass = "app\models\action\User";

    public function afterCreate( $model )
    {
        return $this->redirect(['index']);
    }

    public function afterUpdate( $model )
    {
        return $this->redirect(['view','id'=>$model->id]);
    }

    public function afterDelete( $model )
    {
        return $this->redirect(['index']);
    }
}