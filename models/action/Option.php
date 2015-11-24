<?php

namespace app\models\action;
use app\models\db\Options;
use Yii;

class Option extends Options {
    /**
     * get site options
     * @return array
     */
    public static function getSiteOption() {
        $option = self::findOne(['option_name' => 'site_options']);
        if (!$option) {
            $option = new Options();
            $option->option_name = 'site_options';
            $option->option_value = json_encode([]);
            if (!$option->save()) {
                Yii::error($option->errors);
                return null;
            }
        }
        $data = json_decode($option->option_value, true);
        if (!$data) {
            $data = [];
        }
        return $data;

    }
}
