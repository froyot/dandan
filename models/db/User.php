<?php

namespace app\models\db;

use Yii;

/**
 * This is the model class for table "{{%user}}".
 *
 * @property integer $id
 * @property string $create_at
 * @property string $update_at
 * @property string $name
 * @property string $password
 * @property string $token
 * @property string $last_login_time
 * @property string $last_login_ip
 */
class User extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['create_at', 'update_at', 'last_login_time'], 'safe'],
            [['name', 'password'], 'required'],
            [['name'], 'string', 'max' => 30],
            [['password', 'token'], 'string', 'max' => 100],
            [['last_login_ip'], 'string', 'max' => 4]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'create_at' => 'Create At',
            'update_at' => 'Update At',
            'name' => 'Name',
            'password' => 'Password',
            'token' => 'Token',
            'last_login_time' => 'Last Login Time',
            'last_login_ip' => 'Last Login Ip',
        ];
    }

    public function getRole()
    {
        return $this->hasOne(Role::className(),['user_id'=>'id']);
    }

    /**
     * 获取用户信息
     * @param  int      $userId     用户id
     * @param  string   $role       用户角色
     * @return User                 User对象
     */
    public function getUser( $userId, $role = null )
    {
        if( $role == null )
        {
            return self::findOne( $userId );
        }
        else
        {
            return Role::getUserByRole( $userId, $role );
        }
    }
}
