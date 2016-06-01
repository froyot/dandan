<?php

namespace easydandan\models\db;

use Yii;
use easydandan\components\ActiveRecord;
/**
 * This is the model class for table "dandan_admins".
 *
 * @property integer $admin_id
 * @property string $username
 * @property string $password
 * @property string $auth_key
 * @property string $access_token
 */
class Admins extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'dandan_admins';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'password', 'auth_key'], 'required'],
            [['username'], 'string', 'max' => 32],
            [['password'], 'string', 'max' => 64],
            [['auth_key', 'access_token'], 'string', 'max' => 128],
            [['access_token'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'admin_id' => 'Admin ID',
            'username' => 'Username',
            'password' => 'Password',
            'auth_key' => 'Auth Key',
            'access_token' => 'Access Token',
        ];
    }
}
