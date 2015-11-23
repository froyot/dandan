<?php

namespace app\admin\controllers;

class GuestbookController extends BaseController implements BaseControllerInterface {
    public $modelClass = "app\models\action\Guestbook";

    public $modelFormClass = "app\models\\form\GuestbookForm";

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
