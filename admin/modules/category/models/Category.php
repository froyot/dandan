<?php

namespace admin\modules\category\models;

use Yii;

/**
 * This is the model class for table "{{%category}}".
 *
 * @property integer $cat_id
 * @property integer $parent_id
 * @property string $type
 * @property string $name
 * @property string $des
 * @property integer $status
 * @property string $create_at
 * @property integer $sort_num
 */
class Category extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%category}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['parent_id', 'status', 'sort_num'], 'integer'],
            [['type', 'name', 'des', 'status', 'create_at', 'sort_num'], 'required'],
            [['type'], 'string'],
            [['create_at'], 'safe'],
            [['name', 'des'], 'string', 'max' => 200]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'cat_id' => 'Cat ID',
            'parent_id' => 'Parent ID',
            'type' => 'Type',
            'name' => 'Name',
            'des' => 'Des',
            'status' => 'Status',
            'create_at' => 'Create At',
            'sort_num' => 'Sort Num',
        ];
    }
}
