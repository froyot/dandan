<?php

namespace app\admin\controllers;
use Yii;
use yii\base\Model;
use yii\web\ServerErrorHttpException;

class NavController extends BaseController implements BaseControllerInterface {
    public $modelClass = "app\models\action\Nav";
    public $modelFormClass = "app\models\\form\NavForm";

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

    /**
     * 添加菜单
     * @return mixed
     */
    public function actionCreate() {
        $model = new $this->modelClass([
            'scenario' => Model::SCENARIO_DEFAULT,
        ]);

        if (Yii::$app->getRequest()->getIsGet()) {
            if (Yii::$app->getRequest()->get('parent')) {
                $model->parentid = Yii::$app->getRequest()->get('parent');
            }

        } elseif (Yii::$app->getRequest()->getIsPost()) {
            $model->load(Yii::$app->getRequest()->getBodyParams());
            if ($model->save()) {
                return $this->afterCreate($model);
            } elseif (!$model->hasErrors()) {
                throw new ServerErrorHttpException('Failed to create the object for unknown reason.');
            }

        }
        return $this->render('create', ['model' => $model]);
    }

}
