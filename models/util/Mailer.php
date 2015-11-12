<?php
/**
 * 发送邮件类
 * 调用方式统一采用实例调用
 */
namespace app\models\util;
use yii\base\Model;
use yii\helpers\Url;
use Yii;

class Mailer extends Model{
    private $mail;
    public function init()
    {
        parent::init();
        $this->mail = Yii::$app->mailer->compose();
    }

    /**
     * send register email to user
     * @param  string $email    邮件地址
     * @param  string $username 注册用户名
     * @param  string $code     激活码
     * @return boolean           是否发送成功
     */
    public function sendRegisterMail( $email, $username, $code )
    {
        Yii::trace('sendRegisterMail send mail');
        $this->mail->setTo( $email );
        $this->mail->setSubject( Yii::t('app','active email') );
        $this->mail->setHtmlBody(
            '<p>Hi '.$username.':</p><p>'.
            Yii::t('app','active_code').'<a href="'.
            Yii::$app->request->hostInfo.Url::to(['site/active','code'=>$code]).
            '">'.Yii::t('app','link').'</a>,'.Yii::t('app','or_copy_link').':'.Yii::$app->request->hostInfo.Url::to(['site/active','code'=>$code])
        );    //发布可以带html标签的文本
        if( $this->mail->send() )
        {
            return true;
        }
        else
        {
            Yii::error($this->mail->errors);
            return false;
        }

    }
}

