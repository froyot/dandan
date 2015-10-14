<?php

namespace app\models\db;

use Yii;

/**
 * This is the model class for table "{{%relation}}".
 *
 * @property integer $content_id
 * @property integer $params_id
 */
class Relation extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%relation}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['content_id', 'params_id'], 'required'],
            [['content_id', 'params_id'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'content_id' => 'Content ID',
            'params_id' => 'Params ID',
        ];
    }

    public function getParam()
    {
        return $this->hasOne(Params::className(),['id'=>'params_id']);
    }
}
