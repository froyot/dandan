<?php

namespace easydandan\models\action;

use Yii;
use easydandan\models\db\Admins;

/**
 * This is the model class for table "dandan_admins".
 *
 * @property integer $admin_id
 * @property string $username
 * @property string $password
 * @property string $auth_key
 * @property string $access_token
 */
class Admin extends Admins implements \yii\web\IdentityInterface
{
    static $rootUser = [
        'admin_id' => 0,
        'username' => 'admin',
        'password' => '',
        'auth_key' => '',
        'access_token' => ''
    ];

    public function attributeLabels()
    {
        return [
            'username' => Yii::t('easydandan', 'Username'),
            'password' => Yii::t('easydandan', 'Password'),
        ];
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($this->isNewRecord) {
                $this->auth_key = $this->generateAuthKey();
                $this->password = $this->hashPassword($this->password);
            } else {
                $this->password = $this->password != '' ? $this->hashPassword($this->password) : $this->oldAttributes['password'];
            }
            return true;
        } else {
            return false;
        }
    }

    public static function findIdentity($id)
    {
        $result = null;
        try {
            $result = $id == self::$rootUser['admin_id']
                ? static::createRootUser()
                : static::findOne($id);
        } catch (\yii\base\InvalidConfigException $e) {
        }
        return $result;
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['access_token' => $token]);
    }

    public static function findByUsername($username)
    {
        if ($username === self::$rootUser['username']) {
            return static::createRootUser();
        }
        return static::findOne(['username' => $username]);
    }

    public function getId()
    {
        return $this->admin_id;
    }

    public function getAuthKey()
    {
        return $this->auth_key;
    }

    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    public function validatePassword($password)
    {
        return $this->password === $this->hashPassword($password);
    }

    private function hashPassword($password)
    {
        return sha1($password . $this->getAuthKey() . Setting::get('password_salt'));
    }

    private function generateAuthKey()
    {
        return Yii::$app->security->generateRandomString();
    }

    public static function createRootUser()
    {
        return new static(array_merge(self::$rootUser, [
            'password' => Setting::get('root_password'),
            'auth_key' => Setting::get('root_auth_key')
        ]));
    }

    public function isRoot()
    {
        return $this->username === self::$rootUser['username'];
    }
}
