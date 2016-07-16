<?php
namespace admin\behaviors;

use Yii;
use yii\db\ActiveRecord;

/**
 * key value make php array file
 * @inheritdoc
 */
class StatusModel extends \yii\base\Behavior
{
    public function changeStatus()
    {
        $model = $this->owner;
        $model->status = $model->status?0:1;
        if( $model->save() )
        {
            return true;
        }
    }
}
