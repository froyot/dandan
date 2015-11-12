<?php

namespace app\models\db;

use Yii;

/**
 * This is the model class for table "{{%users}}".
 *
 * @property string $id
 * @property string $user_login
 * @property string $user_pass
 * @property string $user_nicename
 * @property string $user_email
 * @property string $user_url
 * @property string $avatar
 * @property integer $sex
 * @property string $birthday
 * @property string $signature
 * @property string $last_login_ip
 * @property string $last_login_time
 * @property string $create_time
 * @property string $user_activation_key
 * @property integer $user_status
 * @property integer $score
 * @property integer $user_type
 * @property integer $coin
 * @property string $mobile
 */
class Users extends \yii\db\ActiveRecord
{
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
            [['sex', 'user_status', 'score', 'user_type', 'coin'], 'integer'],
            [['last_login_time', 'create_time'], 'date', 'format'=>'yyyy-MM-dd HH:mm:ss'],
            ['birthday', 'date', 'format'=>'yyyy-MM-dd'],
            [['user_login', 'user_activation_key'], 'string', 'max' => 60],
            [['user_pass'], 'string', 'max' => 64],
            [['user_nicename'], 'string', 'max' => 50],
            [['user_email', 'user_url'], 'string', 'max' => 100],
            [['avatar', 'signature'], 'string', 'max' => 255],
            [['last_login_ip'], 'string', 'max' => 16],
            [['mobile'], 'string', 'length' => 11],
            ['mobile','match','pattern'=>'/^[0-9]{11}$/']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_login' => 'User Login',
            'user_pass' => 'User Pass',
            'user_nicename' => 'User Nicename',
            'user_email' => 'User Email',
            'user_url' => 'User Url',
            'avatar' => 'Avatar',
            'sex' => 'Sex',
            'birthday' => 'Birthday',
            'signature' => 'Signature',
            'last_login_ip' => 'Last Login Ip',
            'last_login_time' => 'Last Login Time',
            'create_time' => 'Create Time',
            'user_activation_key' => 'User Activation Key',
            'user_status' => 'User Status',
            'score' => 'Score',
            'user_type' => 'User Type',
            'coin' => 'Coin',
            'mobile' => 'Mobile',
        ];
    }
}
