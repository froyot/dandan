<?php

namespace admin\models\helpers;

use Yii;
use admin\models\Options;
class SessionHelper extends \yii\base\model
{
    const PERFIX = "_PERFIX";

    public static function get($key)
    {
        return Yii::$app->session->get(SessionHelper::PERFIX.$key);
    }

    public static function set($key,$value)
    {
        return Yii::$app->session->set(SessionHelper::PERFIX.$key,$value);
    }

    public static function clear()
    {
        return Yii::$app->session->clear();
    }
}
