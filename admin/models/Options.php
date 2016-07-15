<?php

namespace admin\models;

use Yii;

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
            [['option_key', 'des', 'option_value'], 'required'],
            [['option_key', 'des', 'option_value'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'option_id' => Yii::t('app', 'Option ID'),
            'option_key' => Yii::t('app', 'Option Key'),
            'des' => Yii::t('app', 'Des'),
            'option_value' => Yii::t('app', 'Option Value'),
        ];
    }
}
