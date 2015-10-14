<?php

namespace app\models\db;

use Yii;

/**
 * This is the model class for table "{{%params}}".
 *
 * @property integer $id
 * @property string $name
 * @property string $type
 * @property integer $create_by
 * @property string $create_at
 */
class Params extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%params}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'create_by'], 'required'],
            [['type'], 'string'],
            [['create_by'], 'integer'],
            [['create_at'], 'safe'],
            [['name'], 'string', 'max' => 20]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'type' => 'Type',
            'create_by' => 'Create By',
            'create_at' => 'Create At',
        ];
    }
}
