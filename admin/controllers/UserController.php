<?php

namespace app\admin\controllers;
use app\models\form\ResetPasswordForm;
use Yii;

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

    public function actionResetPassword() {
        $id = intval(Yii::$app->request->get('id'));
        $model = new ResetPasswordForm();
        $model->userId = $id;
        if (!$id) {
            $model->scenario = 'self-edit';
        }
        if (Yii::$app->request->isPost) {
            $model->load(Yii::$app->request->post());
            if ($model->validate() && $model->save()) {
                return $this->redirect(['site/index']);
            }
        }

        return $this->render('resetPassword', ['model' => $model]);
    }
}
