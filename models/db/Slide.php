<?php

namespace app\models\db;

use Yii;

/**
 * This is the model class for table "{{%slide}}".
 *
 * @property string $slide_id
 * @property string $slide_cid
 * @property string $slide_name
 * @property string $slide_pic
 * @property string $slide_des
 * @property string $slide_type
 * @property integer $slide_value
 * @property integer $slide_status
 * @property integer $listorder
 */
class Slide extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%slide}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['slide_cid', 'slide_name'], 'required'],
            [['slide_cid', 'slide_value', 'slide_status', 'listorder'], 'integer'],
            [['slide_type'], 'string'],
            [['slide_name', 'slide_pic', 'slide_des'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'slide_id' => 'Slide ID',
            'slide_cid' => 'Slide Cid',
            'slide_name' => 'Slide Name',
            'slide_pic' => 'Slide Pic',
            'slide_des' => 'Slide Des',
            'slide_type' => 'Slide Type',
            'slide_value' => 'Slide Value',
            'slide_status' => 'Slide Status',
            'listorder' => 'Listorder',
        ];
    }
}
