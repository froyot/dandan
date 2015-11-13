<?php

namespace app\models\form;

use Yii;
use yii\base\Model;
use app\models\action\User;
use yii\base\Event;

use app\compoments\EventHandler;
use app\compoments\MyEvent;

/**
 * LoginForm is the model behind the login form.
 */
class RegisterForm extends Model
{
    public $username;
    public $password;
    public $repassword;
    public $email;
    public $activeCode;
    const EVENT_AFTER_REGISTER = 'afterRegister';

    public function attributeLabels()
    {
        return [
            'username'      => Yii::t('app','username'),
            'password'      => Yii::t('app','password'),
            'repassword'    => Yii::t('app','repassword'),
            'email'         => Yii::t('app','email')
        ];
    }

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['username', 'password','email','repassword'], 'required'],
            ['email','email','message'=>Yii::t('app','email format error')],
            // rememberMe must be a boolean value
            // password is validated by validatePassword()
            ['username', 'valideteUsername'],
            ['email', 'valideteEmail'],
            [
                'repassword','compare',
                'compareAttribute'=>'password',
                'message'=>Yii::t( 'app','double password error' )
            ]
        ];
    }
    public function valideteUsername($attribute, $params)
    {
        if( !$this->hasErrors() )
        {
            if( User::checkUserNameExist( $this->username ) )
            {
                $this->addError( $attribute, Yii::t( 'app','username exist' ) );

            }
        }
    }
    public function valideteEmail($attribute, $params)
    {
        if( !$this->hasErrors() )
        {
            if( User::checkEmailExist( $this->username ) )
            {
                $this->addError( $attribute, Yii::t( 'app','email exist' ) );

            }
        }
    }
    /**
     * create user and login to site
     * @return int login ok return 1, login error return 0, register error return -1
     */
    public function register()
    {
        if ($this->validate())
        {
           $user = new User();
           $user->attributes = [
            'user_login' => $this->username,
            'user_email' => $this->email,
            'password'  => $this->password
           ];
           if( $user->save() )
           {
                Yii::trace('register success');
                $this->activeCode = $user->getActiveCode();
                $event = new MyEvent();
                $event->context = $this;
                Yii::$app->myEvent->trigger(EventHandler::MY_EVENT_AFTER_REGISTER,$event);
                if( Yii::$app->user->login($user) )
                {
                    return 1;
                }
                else
                {
                    //login error, return 0
                    return 0;
                }
           }
           else
           {
                $this->addErrors( $user->getErrors() );
                return -1;
           }

        }
        else
        {
            return -1;
        }
    }

    private function afterRegister()
    {
        $mail = new Mailer();
        $mail->sendRegisterMail( $this->email, $this->username, $this->activeCode );
    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    public function getUser()
    {
        if ($this->_user === false) {
            if(strpos($this->username,"@")>0)
            {
                //邮箱登陆
                $this->_user = User::findOne(['user_email'=>$this->username]);
            }
            else
            {
                $this->_user = User::findOne(['user_login'=>$this->username]);
            }
        }
        return $this->_user;
    }

}
