<?php

namespace admin\models;

use Yii;
use admin\behaviors\FileConfig;
use yii\helpers\ArrayHelper;
/**
 * This is the model class for table "options".
 *
 * @property integer $option_id
 * @property string $option_key
 * @property string $des
 * @property string $option_value
 */
class Options extends \yii\db\ActiveRecord
{
    const OPTIONS_FILE_CONFIG = 'options';
    public function behaviors()
    {
        return ArrayHelper::merge(
            parent::behaviors(),
            [
                [
                'class'=>FileConfig::className(),
                'dataKey'=>Options::OPTIONS_FILE_CONFIG
                ]
            ]
        );
    }
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'options';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['key', 'des', 'value'], 'required'],
            [['key', 'des', 'value'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'option_id' => Yii::t('app', 'Option ID'),
            'key' => Yii::t('app', 'Option Key'),
            'des' => Yii::t('app', 'Des'),
            'value' => Yii::t('app', 'Option Value'),
        ];
    }




}
