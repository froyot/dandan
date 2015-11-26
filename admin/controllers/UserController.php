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

    /**
     * CheckOwnPermission
     * @author Allon<xianlong300@sina.com>
     * @dateTime 2015-11-26T15:56:41+0800
     * @param    boolean        if edit own data
     */
    protected function CheckOwnPermission($action) {
        if ($action->id == 'reset-password') {
            $id = intval(Yii::$app->request->get('id'));
            if (!$id || $id == Yii::$app->user->id) {
                return true;
            }
            return false;
        }
    }
}
