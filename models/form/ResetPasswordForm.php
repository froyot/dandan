<?php

namespace app\models\form;

use app\models\action\User;
use Yii;
use yii\base\Model;

/**
 * LoginForm is the model behind the login form.
 */
class ResetPasswordForm extends Model {
    public $oldPassword;
    public $password;
    public $repeatPassword;
    public $userId = 0;

    private $_user = false;

    /**
     * @return array the validation rules.
     */
    public function rules() {
        return [
            // username and password are both required
            [['oldPassword'], 'required', 'on' => 'self-edit'],
            [['password', 'repeatPassword'], 'required'],
            ['oldPassword', 'validatePassword'],
        ];
    }
    public function attributeLabels() {
        return [
            'oldPassword' => Yii::t('app', 'oldPassword'),
            'repeatPassword' => Yii::t('app', 'repeatPassword'),
            'password' => Yii::t('app', 'password'),
        ];
    }

    public function getUserLogin() {
        $user = $this->getUser();
        if ($user) {
            return $user->user_login;
        }
    }
    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params) {
        if (!$this->hasErrors()) {
            $user = $this->getUser();

            if (!$user || !$user->validatePassword($this->oldPassword)) {
                $this->addError($attribute, 'Incorrect username or password.');
            }
        }
    }

    public function save() {
        $user = $this->getUser();
        $user->password = $this->password;
        return $user->save();
    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    public function getUser() {
        if ($this->_user === false) {
            if ($this->userId == 0) {
                $this->userId = Yii::$app->user->id;
            }
            $this->_user = User::findOne($this->userId);
        }
        return $this->_user;
    }
}
