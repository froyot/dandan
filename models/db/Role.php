<?php

namespace app\models\db;

use Yii;

/**
 * This is the model class for table "{{%role}}".
 *
 * @property integer $user_id
 * @property string $role
 */
class Role extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%role}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id'], 'integer'],
            [['role'], 'string'],
            [['user_id'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'user_id' => 'User ID',
            'role' => 'Role',
        ];
    }

    public function getUser()
    {
        return $this->hasOne(User::className(),['user_id'=>'user_id']);
    }

    /**
     * 根据权限以及用户id获取用户
     * @param  int      $userId     用户id
     * @param  string   $role       字符串
     * @return User                 User对象
     */
    public function getUserByRole( $userId, $role )
    {
        if( $role = self::findOne( $userId, $role ) )
        {
            return $role->getUser();
        }
        else
            return null;
    }


}
