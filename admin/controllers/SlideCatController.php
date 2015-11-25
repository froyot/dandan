<?php

namespace app\admin\controllers;

use app\models\action\slideCat;
use yii\web\Controller;

/**
 * SlideCatController implements the CRUD actions for slideCat model.
 */
class SlideCatController extends BaseController implements BaseControllerInterface {
    public $modelClass = "app\models\action\SlideCat";
    public $modelFormClass = "app\models\\form\SlideCatForm";
    public $addParams = ['cat_is_default' => 0];

    public function afterCreate($model) {
        return $this->redirect(['index']);
    }

    public function afterUpdate($model) {
        return $this->redirect(['index']);
    }

    public function afterDelete($model) {
        return $this->redirect(['index']);
    }
    public function beforeRenderEdit(&$model) {

    }
}
