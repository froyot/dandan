<?php

namespace app\controllers;
use yii\base\Model;
use Yii;


class NavController extends BaseController implements BaseControllerInterface
{
    public $modelClass = "app\models\action\Nav";
    public $modelFormClass = "app\models\\form\NavForm";

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



}
