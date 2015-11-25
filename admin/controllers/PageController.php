<?php

/**
 * 页面管理
 */
namespace app\admin\controllers;

class PageController extends BaseController implements BaseControllerInterface {

    public static $SCENARIO_INSERT = 'page';
    public static $SCENARIO_UPDATE = 'page';
    public $modelClass = "app\models\action\Post";
    public $modelFormClass = "app\models\\form\PostForm";

    public function beforeAction($action) {
        if (parent::beforeAction($action)) {

            if ($action->id == 'index') {
                $this->addParams['post_type'] = 'page';
            }
        }
        return true;
    }
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
