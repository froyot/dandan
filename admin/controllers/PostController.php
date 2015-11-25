<?php

namespace app\admin\controllers;

use app\models\action\Post;
use app\models\action\TermRelationship;
use yii\web\Controller;

/**
 * PostController implements the CRUD actions for Post model.
 */
class PostController extends BaseController implements BaseControllerInterface {
    public static $SCENARIO_INSERT = 'post';
    public static $SCENARIO_UPDATE = 'post';
    public $modelClass = "app\models\action\Post";
    public $modelFormClass = "app\models\\form\PostForm";
    public $addParams = ['post_type' => 'post'];
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
        $cat = TermRelationship::find()
            ->where(['object_id' => $model->getPrimaryKey()])
            ->select(['term_id'])->one();
        if ($cat) {
            $model->cat_id = $cat->term_id;
        }

    }
}
