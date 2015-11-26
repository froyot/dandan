<?php

namespace app\admin\controllers;

class UserController extends BaseController implements BaseControllerInterface {
    public $modelClass = "app\models\action\User";
    public $modelFormClass = "app\models\\form\UserForm";

    /**
     * @param $model
     * @return mixed
     */
    public function afterCreate($model) {
        return $this->redirect(['index']);
    }

    /**
     * @param $model
     * @return mixed
     */
    public function afterUpdate($model) {
        return $this->redirect(['index']);
    }

    /**
     * @param $model
     * @return mixed
     */
    public function afterDelete($model) {
        return $this->redirect(['index']);
    }
    /**
     * @param $model
     */
    public function beforeRenderEdit(&$model) {

    }
}
