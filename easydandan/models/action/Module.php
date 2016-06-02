<?php

namespace easydandan\models\action;

use Yii;
use easydandan\Helpers\Data;
use easydandan\behaviors\SortableModel;
use yii\Helpers\ArrayHelper;
/**
 * This is the model class for table "dandan_modules".
 *
 * @property integer $module_id
 * @property string $name
 * @property string $class
 * @property string $title
 * @property string $icon
 * @property string $settings
 * @property integer $notice
 * @property integer $order_num
 * @property integer $status
 */
class Module extends \easydandan\models\db\Modules
{
    const CACHE_KEY = 'dandan_modules';

    public function behaviors()
    {
        return ArrayHelper::merge(
            parent::behaviors(),
            [
                [
                    'class' => SortableModel::className(),
                ],
            ]);
    }

    public static function findAllActive()
    {
        return Data::cache(self::CACHE_KEY, 3600, function(){
            $result = [];
            try {
                foreach (self::find()->where(['status' => self::STATUS_ON])->sort()->all() as $module) {
                    $module->trigger(self::EVENT_AFTER_FIND);
                    $result[$module->name] = (object)$module->attributes;
                }
            }catch(\yii\db\Exception $e){}

            return $result;
        });
    }
}
