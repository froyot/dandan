<?php

namespace admin\modules\user\models;

use Yii;
use yii\helpers\ArrayHelper;
/**
 * This is the model class for table "{{%users}}".
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
                    'class'=>'admin\behaviors\StatusModel'
                ],
                
            ]
        );
    }
        /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%users}}';
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
            [['password'], 'string', 'max' => 40],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'user_id' => 'User ID',
            'username' => 'Username',
            'password' => 'Password',
            'create_at' => 'Create At',
            'status' => 'Status',
        ];
    }
}
