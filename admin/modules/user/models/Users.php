<?php

namespace admin\modules\user\models;

use Yii;
use admin\behaviors\StatusModel;
use yii\helpers\ArrayHelper;
/**
 * This is the model class for table "users".
 *
 * @property integer $user_id
 * @property string $username
 * @property string $password
 * @property string $create_at
 * @property integer $status
 */
class Users extends \yii\db\ActiveRecord
{

    public function behaviors()
    {
        return ArrayHelper::merge(
            parent::behaviors(),
            [
                [
                'class'=>StatusModel::className(),
                ],

            ]
        );
    }
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'users';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'password', 'create_at'], 'required'],
            [['create_at'], 'safe'],
            [['status'], 'integer'],
            [['username'], 'string', 'max' => 20],
            [['password'], 'string', 'max' => 40]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'user_id' => Yii::t('app', 'User ID'),
            'username' => Yii::t('app', 'Username'),
            'password' => Yii::t('app', 'Password'),
            'create_at' => Yii::t('app', 'Create At'),
            'status' => Yii::t('app', 'Status'),
        ];
    }
}
