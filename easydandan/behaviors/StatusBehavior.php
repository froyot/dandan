<?php
namespace easydandan\behaviors;

use Yii;

/**
 * Status behavior. Adds statuses to models
 * @package yii\easyii\behaviors
 */
class StatusBehavior extends \yii\base\Behavior
{
    const STATUS_ON = 1;
    const STATUS_OFF = 0;
    public $model;
    public $error;

    public function changeStatus($id, $status)
    {
        $modelClass = $this->model;

        if(($model = $modelClass::findOne($id))){
            $model->status = $status;
            if( !$model->update() )
            {
                $this->error = Yii::t('easydandan', 'Not found');
            }

        }
        else{
            $this->error = Yii::t('easydandan', 'Not found');
        }

        return $this->owner->formatResponse(Yii::t('easydandan', 'Status successfully changed'));
    }
}
