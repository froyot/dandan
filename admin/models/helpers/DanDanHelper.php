<?php

namespace admin\models\helpers;

use Yii;
use admin\models\Options;
class DanDanHelper extends \yii\base\model
{
    public static function getOption($key)
    {
        if(isset( Yii::$app->params[Options::OPTIONS_FILE_CONFIG][$key]) )
        {
            return Yii::$app->params[Options::OPTIONS_FILE_CONFIG][$key];
        }
        else
        {
            $option = Options::findOne(['key'=>$key]);
            if($option)
            {
                return $option->value;
            }
            return $key;
        }

    }
}
