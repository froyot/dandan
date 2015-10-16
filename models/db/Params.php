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
            [['name', 'type'], 'required'],
            [['type'], 'string'],
            [['created_by'], 'integer'],
            [['created_at'], 'safe'],
            [['name'], 'string', 'max' => 20],
            ['created_at','default','value'=>date('Y-m-d H:i:s')],
            ['created_by','default','value'=>Yii::$app->user->id]
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
            'created_by' => 'Create By',
            'created_at' => 'Create At',
        ];
    }
}
