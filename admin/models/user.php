<?php

namespace app\admin\models;
use app\models\db\User as AdminModel;
use Yii;
class User extends AdminModel implements \yii\web\IdentityInterface
{
    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        $user = self::find()->joinWith('role')->where(['id'=>$id,'role.role'=>'admin'])->one();
        return $user;
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        $user = self::find()->joinWith('role')->where(['token'=>$token,'role.role'=>'admin'])->one();
        return $user;
    }

    /**
     * Finds user by username
     *
     * @param  string      $name
     * @return static|null
     */
    public static function findByUsername($name)
    {
        $user = self::find()->joinWith('role')->where(['name'=>$name,'role.role'=>'admin'])->one();
        return $user;
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return '';
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return false;
    }

    /**
     * Validates password
     *
     * @param  string  $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password);
    }
}
