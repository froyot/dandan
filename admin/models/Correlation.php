<?php

namespace admin\models;

use Yii;

/**
 * This is the model class for table "correlation".
 *
 * @property string $model
 * @property string $cor_model
 * @property integer $model_id
 * @property integer $cor_model_id
 */
class Correlation extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'correlation';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['model', 'cor_model', 'model_id', 'cor_model_id'], 'required'],
            [['model_id', 'cor_model_id'], 'integer'],
            [['model', 'cor_model'], 'string', 'max' => 20]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'model' => Yii::t('app', 'Model'),
            'cor_model' => Yii::t('app', 'Cor Model'),
            'model_id' => Yii::t('app', 'Model ID'),
            'cor_model_id' => Yii::t('app', 'Cor Model ID'),
        ];
    }

    public function getCorModel($corModelClass)
    {
            $model = Yii::createObject($corModelClass);
            return $model->findOne($this->cor_model);
    }

    public function getCorModelName($corModelClass)
    {
        $model = Yii::createObject($corModelClass);
        $model = $model->findOne($this->cor_model_id);
        if($model)
        {
            return $model->name;
        }
        return '';
    }
}
