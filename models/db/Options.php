<?php

namespace app\models\db;

use Yii;

/**
 * This is the model class for table "{{%options}}".
 *
 * @property string $option_id
 * @property string $option_name
 * @property string $option_value
 * @property integer $autoload
 */
class Options extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%options}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['option_value'], 'required'],
            [['option_value'], 'string'],
            [['autoload'], 'integer'],
            [['option_name'], 'string', 'max' => 64],
            [['option_name'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'option_id' => 'Option ID',
            'option_name' => 'Option Name',
            'option_value' => 'Option Value',
            'autoload' => 'Autoload',
        ];
    }
}
