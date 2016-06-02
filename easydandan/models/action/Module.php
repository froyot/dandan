<?php

namespace easydandan\models\action;

use Yii;
use easydandan\Helpers\Data;
use easydandan\behaviors\SortableModel;
use easydandan\behaviors\CacheFlush;
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
    public static $count = 1;
    const CACHE_KEY = 'dandan_modules';

    public function behaviors()
    {
        return ArrayHelper::merge(
            parent::behaviors(),
            [
                SortableModel::className(),
                CacheFlush::className(),

            ]
        );
    }



    public static function findAllActive()
    {

        return Data::cache(self::CACHE_KEY, 3600, function(){

            $result = [];
            try {
                $models = self::find()->where(['status' => self::STATUS_ON])->sort()->all();

                foreach ($models as $module) {

                    $module->trigger(self::EVENT_AFTER_FIND);
                    $result[$module->name] = (object)$module->attributes;
                }
            }catch(\yii\db\Exception $e){}


            return $result;
        });
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if(!$this->settings || !is_array($this->settings)){
                $this->settings = self::getDefaultSettings($this->class,$this->name);
            }
            $this->settings = json_encode($this->settings);

            return true;
        } else {
            return false;
        }
    }

    public function afterFind()
    {
        parent::afterFind();
        $this->settings = $this->settings !== ''  ? json_decode($this->settings, true):'';
    }

    static function getDefaultSettings($class,$name)
    {


        $model =  Yii::createObject($class,[$name]);
        if($model)
            return $model->settings;
        return [];


    }
}
