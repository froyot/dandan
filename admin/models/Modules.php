<?php

namespace admin\models;

use Yii;

/**
 * This is the model class for table "modules".
 *
 * @property integer $module_id
 * @property string $name
 * @property string $des
 * @property string $path
 * @property string $create_at
 */
class Modules extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'modules';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'des', 'path', 'create_at','status'], 'required'],
            [['create_at'], 'safe'],
            [['name', 'des', 'path'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'module_id' => Yii::t('app', 'Module ID'),
            'name' => Yii::t('app', 'Name'),
            'des' => Yii::t('app', 'Des'),
            'path' => Yii::t('app', 'Path'),
            'status'=>Yii::t('app','Status'),
            'create_at' => Yii::t('app', 'Create At'),
        ];
    }
}
