<?php
/**
 * 事件处理类
 *
 */
namespace app\compoments;
use yii\base\Component;
use yii\helpers\Url;
use app\models\util\Mailer;
use Yii;

class EventHandler extends Component{

    const MY_EVENT_AFTER_POST = 'afterPost';
    const MY_EVENT_AFTER_COMMENT = 'afterComment';
    const MY_EVENT_AFTER_DELETE_POST = 'afterDeletePost';
    const MY_EVENT_AFTER_DELETE_COMMENT = 'afterDeletePost';
    const MY_EVENT_AFTER_REGISTER = 'afterRegister';
    const MY_EVENT_AFTER_LOGIN = 'afterLogin';

    public function init()
    {
        parent::init();
        //绑定事件登录后事件
        Yii::$app->user->on(yii\web\User::EVENT_AFTER_LOGIN,[$this,self::MY_EVENT_AFTER_LOGIN]);
        //绑定注册后事件
        $this->on(self::MY_EVENT_AFTER_REGISTER,[$this,self::MY_EVENT_AFTER_REGISTER]);
    }
    /**
     * 登录后的操作
     * @return null
     */
    public function afterLogin($event)
    {
        //更新上次登录时间以及登录ip
        $identity = $event->identity;
        $identity->last_login_time = date('Y-m-d H:i:s');
        $identity->last_login_ip = Yii::$app->request->getUserIP();
        $identity->save();
    }

    /**
     * 注册后的操作
     * @param   $event [description]
     * @return null
     */
    public function afterRegister( $event )
    {
        $obj = $event->context;
        $mail = new Mailer();
        $mail->sendRegisterMail( $obj->email, $obj->username, $obj->activeCode );
    }

}
