<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace easydandan\actions;

use Yii;
use yii\web\ServerErrorHttpException;
use yii\rest\Action;
use yii\widgets\ActiveForm;

/**
 * DeleteAction implements the API endpoint for deleting a model.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class DeleteAction extends Action
{
    /**
     * Deletes a model.
     * @param mixed $id id of the model to be deleted.
     * @throws ServerErrorHttpException on failure.
     */
    public function run($id)
    {
        $model = $this->findModel($id);

        if ($this->checkAccess) {
            call_user_func($this->checkAccess, $this->id, $model);
        }
        $res = $model->delete();

        if(!$res){
            throw new ServerErrorHttpException('Failed to delete the object for unknown reason.');
        }
        $reflect = new \ReflectionClass($model);
        return $this->controller->formatResponse(Yii::t('easydandan', $reflect->getShortName().' deleted'));
    }
}
