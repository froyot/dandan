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
 * @property integer $des
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
            [['parent_id', 'des', 'status', 'sort_num'], 'integer'],
            [['type', 'name', 'des', 'status', 'create_at', 'sort_num'], 'required'],
            [['type'], 'string'],
            [['create_at'], 'safe'],
            [['name'], 'string', 'max' => 200]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'cat_id' => Yii::t('app', 'Cat ID'),
            'parent_id' => Yii::t('app', 'Parent ID'),
            'type' => Yii::t('app', 'Type'),
            'name' => Yii::t('app', 'Name'),
            'des' => Yii::t('app', 'Des'),
            'status' => Yii::t('app', 'Status'),
            'create_at' => Yii::t('app', 'Create At'),
            'sort_num' => Yii::t('app', 'Sort Num'),
        ];
    }
}
