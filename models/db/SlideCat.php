<?php

namespace app\models\db;

use Yii;

/**
 * This is the model class for table "{{%slide_cat}}".
 *
 * @property string $cid
 * @property string $cat_name
 * @property string $cat_idname
 * @property string $cat_remark
 * @property integer $cat_status
 */
class SlideCat extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%slide_cat}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cat_name', 'cat_idname'], 'required'],
            [['cat_remark'], 'string'],
            [['cat_status'], 'integer'],
            [['cat_name', 'cat_idname'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'cid' => 'Cid',
            'cat_name' => 'Cat Name',
            'cat_idname' => 'Cat Idname',
            'cat_remark' => 'Cat Remark',
            'cat_status' => 'Cat Status',
        ];
    }
}
