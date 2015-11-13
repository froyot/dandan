<?php

namespace app\models\db;

use Yii;

/**
 * This is the model class for table "{{%nav_cat}}".
 *
 * @property integer $navcid
 * @property string $name
 * @property integer $active
 * @property string $remark
 */
class NavCat extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%nav_cat}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['active'], 'integer'],
            [['remark'], 'string'],
            [['name'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'navcid' => 'Navcid',
            'name' => 'Name',
            'active' => 'Active',
            'remark' => 'Remark',
        ];
    }
}
