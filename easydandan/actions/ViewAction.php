<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace easydandan\actions;

use Yii;
use yii\base\Model;
use yii\db\ActiveRecord;
use yii\web\ServerErrorHttpException;
use yii\rest\Action;
use yii\widgets\ActiveForm;

/**
 * UpdateAction implements the API endpoint for updating a model.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class ViewAction extends Action
{
    /**
     * @var string the scenario to be assigned to the model before it is validated and updated.
     */
    public $scenario = Model::SCENARIO_DEFAULT;


    /**
     * Updates an existing model.
     * @param string $id the primary key of the model.
     * @return \yii\db\ActiveRecordInterface the model being updated
     * @throws ServerErrorHttpException if there is any error when updating the model
     */
    public function run($id)
    {
        /* @var $model ActiveRecord */
        $model = $this->findModel($id);

        if ($this->checkAccess) {
            call_user_func($this->checkAccess, $this->id, $model);
        }

        $model->scenario = $this->scenario;

        if($model === null){
            $this->flash('error', Yii::t('easydandan', 'Not found'));
            return $this->redirect($this->controller->getReturnUrl());
        }

        return $this->controller->render('view', [
            'model' => $model
        ]);

    }
}
